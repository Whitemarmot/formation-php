<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de commande</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f4f4;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width: 600px; margin: 0 auto; background-color: #ffffff;">
        <!-- Header -->
        <tr>
            <td style="background-color: #1a1a2e; padding: 30px; text-align: center;">
                <h1 style="color: #ffffff; margin: 0; font-size: 24px;">
                    Formations Soudeuse a Points
                </h1>
            </td>
        </tr>

        <!-- Content -->
        <tr>
            <td style="padding: 40px 30px;">
                <h2 style="color: #1a1a2e; margin: 0 0 20px 0; font-size: 22px;">
                    Merci pour votre commande !
                </h2>

                <p style="color: #333333; font-size: 16px; line-height: 1.6; margin: 0 0 20px 0;">
                    Bonjour {{ $order->customer_name }},
                </p>

                <p style="color: #333333; font-size: 16px; line-height: 1.6; margin: 0 0 30px 0;">
                    Votre commande <strong>{{ $order->order_number }}</strong> a ete confirmee.
                    Vos formations sont pretes a etre telechargees.
                </p>

                <!-- Order Summary -->
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border: 1px solid #e0e0e0; border-radius: 8px; margin-bottom: 30px;">
                    <tr>
                        <td style="background-color: #f8f8f8; padding: 15px; border-bottom: 1px solid #e0e0e0;">
                            <strong style="color: #1a1a2e;">Recapitulatif de votre commande</strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px;">
                            @foreach($order->items as $item)
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin-bottom: 15px;">
                                    <tr>
                                        <td style="color: #333333; font-size: 14px;">
                                            {{ $item->formation_name }}
                                        </td>
                                        <td style="color: #333333; font-size: 14px; text-align: right; white-space: nowrap;">
                                            {{ number_format($item->unit_price, 2, ',', ' ') }} EUR
                                        </td>
                                    </tr>
                                </table>
                            @endforeach

                            <hr style="border: none; border-top: 1px solid #e0e0e0; margin: 15px 0;">

                            @if($order->discount > 0)
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin-bottom: 10px;">
                                    <tr>
                                        <td style="color: #333333; font-size: 14px;">Sous-total</td>
                                        <td style="color: #333333; font-size: 14px; text-align: right;">
                                            {{ number_format($order->subtotal, 2, ',', ' ') }} EUR
                                        </td>
                                    </tr>
                                </table>
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin-bottom: 10px;">
                                    <tr>
                                        <td style="color: #22c55e; font-size: 14px;">Reduction Pack Complet</td>
                                        <td style="color: #22c55e; font-size: 14px; text-align: right;">
                                            -{{ number_format($order->discount, 2, ',', ' ') }} EUR
                                        </td>
                                    </tr>
                                </table>
                            @endif

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="color: #1a1a2e; font-size: 18px; font-weight: bold;">Total</td>
                                    <td style="color: #1a1a2e; font-size: 18px; font-weight: bold; text-align: right;">
                                        {{ number_format($order->total, 2, ',', ' ') }} EUR
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <!-- Download Links -->
                <h3 style="color: #1a1a2e; margin: 0 0 20px 0; font-size: 18px;">
                    Vos liens de telechargement
                </h3>

                @foreach($downloads as $download)
                    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #f8f8f8; border-radius: 8px; margin-bottom: 15px;">
                        <tr>
                            <td style="padding: 20px;">
                                <p style="color: #333333; font-size: 16px; font-weight: bold; margin: 0 0 10px 0;">
                                    {{ $download->formation->name ?? 'Formation' }}
                                </p>
                                <p style="color: #666666; font-size: 14px; margin: 0 0 15px 0;">
                                    Valide jusqu'au {{ $download->expires_at->format('d/m/Y') }}
                                    ({{ $download->remaining_downloads }} telechargements restants)
                                </p>
                                <a href="{{ route('download.file', ['token' => $download->token]) }}"
                                   style="display: inline-block; background-color: #e94560; color: #ffffff; text-decoration: none; padding: 12px 24px; border-radius: 6px; font-size: 14px; font-weight: bold;">
                                    Telecharger le PDF
                                </a>
                            </td>
                        </tr>
                    </table>
                @endforeach

                <p style="color: #666666; font-size: 14px; line-height: 1.6; margin: 30px 0 0 0;">
                    Les PDFs sont personnalises avec votre nom et votre email pour garantir la tracabilite de votre licence.
                </p>

                @if($order->user_id)
                    <p style="color: #666666; font-size: 14px; line-height: 1.6; margin: 20px 0 0 0;">
                        Vous pouvez egalement acceder a vos telechargements depuis votre
                        <a href="{{ route('account.downloads') }}" style="color: #e94560;">espace client</a>.
                    </p>
                @endif
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background-color: #1a1a2e; padding: 30px; text-align: center;">
                <p style="color: #ffffff; font-size: 14px; margin: 0 0 10px 0;">
                    Une question ? Contactez-nous a
                    <a href="mailto:{{ config('mail.from.address') }}" style="color: #e94560;">{{ config('mail.from.address') }}</a>
                </p>
                <p style="color: #888888; font-size: 12px; margin: 0;">
                    &copy; {{ date('Y') }} Formations Soudeuse a Points. Tous droits reserves.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
