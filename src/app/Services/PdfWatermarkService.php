<?php

namespace App\Services;

use App\Models\Formation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PdfWatermarkService
{
    protected string $outputPath;
    protected string $tempPath;

    public function __construct()
    {
        $this->outputPath = storage_path('app/formations/watermarked');
        $this->tempPath = storage_path('app/temp');

        // Ensure directories exist
        if (!is_dir($this->outputPath)) {
            mkdir($this->outputPath, 0755, true);
        }
        if (!is_dir($this->tempPath)) {
            mkdir($this->tempPath, 0755, true);
        }
    }

    /**
     * Generate a watermarked PDF for a customer.
     */
    public function generateWatermarkedPdf(
        Formation $formation,
        string $customerName,
        string $customerEmail,
        string $orderNumber
    ): string {
        $sourcePath = storage_path('app/' . $formation->pdf_path);

        if (!file_exists($sourcePath)) {
            throw new \RuntimeException("Source PDF not found: {$formation->pdf_path}");
        }

        // Generate unique filename
        $filename = sprintf(
            '%s_%s_%s.pdf',
            Str::slug($formation->name),
            $orderNumber,
            Str::random(8)
        );

        $outputFile = $this->outputPath . '/' . $filename;

        // Create watermark text
        $watermarkText = sprintf(
            'Licence accordée à: %s | %s | Commande: %s | %s',
            $customerName,
            $customerEmail,
            $orderNumber,
            now()->format('d/m/Y')
        );

        try {
            // Method 1: Use pdftk if available
            if ($this->isPdftkAvailable()) {
                $this->applyWatermarkWithPdftk($sourcePath, $outputFile, $watermarkText, $customerName);
            }
            // Method 2: Use Ghostscript
            elseif ($this->isGhostscriptAvailable()) {
                $this->applyWatermarkWithGhostscript($sourcePath, $outputFile, $watermarkText, $customerName);
            }
            // Method 3: Just copy (fallback)
            else {
                Log::warning('No PDF watermarking tool available, copying without watermark');
                copy($sourcePath, $outputFile);
            }

            return 'formations/watermarked/' . $filename;
        } catch (\Exception $e) {
            Log::error('PDF watermarking failed', [
                'formation_id' => $formation->id,
                'error' => $e->getMessage(),
            ]);

            // Fallback: copy without watermark
            copy($sourcePath, $outputFile);

            return 'formations/watermarked/' . $filename;
        }
    }

    /**
     * Check if pdftk is available.
     */
    protected function isPdftkAvailable(): bool
    {
        $result = Process::run('which pdftk');
        return $result->successful();
    }

    /**
     * Check if Ghostscript is available.
     */
    protected function isGhostscriptAvailable(): bool
    {
        $result = Process::run('which gs');
        return $result->successful();
    }

    /**
     * Apply watermark using pdftk.
     */
    protected function applyWatermarkWithPdftk(
        string $sourcePath,
        string $outputPath,
        string $watermarkText,
        string $customerName
    ): void {
        // Create watermark PDF using LaTeX
        $watermarkPdf = $this->createWatermarkPdf($watermarkText, $customerName);

        // Apply watermark with pdftk
        $command = sprintf(
            'pdftk %s multistamp %s output %s',
            escapeshellarg($sourcePath),
            escapeshellarg($watermarkPdf),
            escapeshellarg($outputPath)
        );

        $result = Process::run($command);

        // Clean up temp watermark
        @unlink($watermarkPdf);

        if (!$result->successful()) {
            throw new \RuntimeException('pdftk watermarking failed: ' . $result->errorOutput());
        }
    }

    /**
     * Apply watermark using Ghostscript.
     */
    protected function applyWatermarkWithGhostscript(
        string $sourcePath,
        string $outputPath,
        string $watermarkText,
        string $customerName
    ): void {
        // Create PostScript watermark
        $psFile = $this->tempPath . '/' . Str::random(16) . '.ps';

        $psContent = $this->generatePostScriptWatermark($watermarkText, $customerName);
        file_put_contents($psFile, $psContent);

        // Apply watermark with Ghostscript
        $command = sprintf(
            'gs -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile=%s %s %s',
            escapeshellarg($outputPath),
            escapeshellarg($psFile),
            escapeshellarg($sourcePath)
        );

        $result = Process::run($command);

        // Clean up
        @unlink($psFile);

        if (!$result->successful()) {
            throw new \RuntimeException('Ghostscript watermarking failed: ' . $result->errorOutput());
        }
    }

    /**
     * Create a watermark PDF using LaTeX.
     */
    protected function createWatermarkPdf(string $watermarkText, string $customerName): string
    {
        $texFile = $this->tempPath . '/' . Str::random(16) . '.tex';
        $pdfFile = str_replace('.tex', '.pdf', $texFile);

        $texContent = <<<LATEX
\\documentclass{article}
\\usepackage[paperwidth=595pt,paperheight=842pt,margin=0pt]{geometry}
\\usepackage{tikz}
\\usepackage{fontspec}
\\pagestyle{empty}
\\begin{document}
\\begin{tikzpicture}[remember picture,overlay]
    \\node[rotate=45, scale=2, opacity=0.03, text=gray] at (current page.center) {{$customerName}};
    \\node[anchor=south, opacity=0.4, font=\\tiny\\sffamily] at ([yshift=8pt]current page.south) {{$watermarkText}};
\\end{tikzpicture}
\\end{document}
LATEX;

        file_put_contents($texFile, $texContent);

        // Compile with lualatex
        $command = sprintf(
            'cd %s && lualatex -interaction=nonstopmode %s',
            escapeshellarg($this->tempPath),
            escapeshellarg(basename($texFile))
        );

        $result = Process::timeout(60)->run($command);

        // Clean up tex auxiliary files
        @unlink($texFile);
        @unlink(str_replace('.tex', '.aux', $texFile));
        @unlink(str_replace('.tex', '.log', $texFile));

        if (!file_exists($pdfFile)) {
            throw new \RuntimeException('LaTeX watermark compilation failed');
        }

        return $pdfFile;
    }

    /**
     * Generate PostScript watermark code.
     */
    protected function generatePostScriptWatermark(string $watermarkText, string $customerName): string
    {
        return <<<PS
%!PS
/watermark {
    gsave
    0.95 setgray
    /Helvetica findfont 60 scalefont setfont
    306 421 moveto
    45 rotate
    ({$customerName}) dup stringwidth pop 2 div neg 0 rmoveto show
    grestore

    gsave
    0.6 setgray
    /Helvetica findfont 6 scalefont setfont
    306 10 moveto
    ({$watermarkText}) dup stringwidth pop 2 div neg 0 rmoveto show
    grestore
} def

<<
    /EndPage {
        2 eq { pop false } { watermark true } ifelse
    }
>> setpagedevice
PS;
    }

    /**
     * Generate watermark using Docker LaTeX container.
     */
    public function generateWithDocker(
        Formation $formation,
        string $customerName,
        string $customerEmail,
        string $orderNumber
    ): string {
        $filename = sprintf(
            '%s_%s_%s.pdf',
            Str::slug($formation->name),
            $orderNumber,
            Str::random(8)
        );

        $command = sprintf(
            'docker exec formation_latex /usr/local/bin/compile.sh /workspace/%s %s %s %s',
            escapeshellarg($formation->pdf_path),
            escapeshellarg($customerEmail),
            escapeshellarg($customerName),
            escapeshellarg($orderNumber)
        );

        $result = Process::timeout(120)->run($command);

        if (!$result->successful()) {
            Log::error('Docker LaTeX watermarking failed', [
                'error' => $result->errorOutput(),
            ]);
            throw new \RuntimeException('Docker LaTeX watermarking failed');
        }

        return 'formations/watermarked/' . $filename;
    }
}
