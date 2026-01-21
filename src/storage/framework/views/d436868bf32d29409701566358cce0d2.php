<?php if (isset($component)) { $__componentOriginal4619374cef299e94fd7263111d0abc69 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4619374cef299e94fd7263111d0abc69 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('title', null, []); ?> Formations Soudage par Points | Mang-Ky Ha <?php $__env->endSlot(); ?>

    <!-- Hero Section -->
    <section class="relative min-h-[90vh] flex items-center hero-gradient grid-bg">
        <div class="container mx-auto px-4 py-20">
            <div class="max-w-4xl mx-auto text-center">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 bg-dark-card border border-gray-700 rounded-full px-4 py-2 mb-8">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                    <span class="text-sm text-gray-300">15 ans d'expertise industrielle</span>
                </div>

                <!-- Headline -->
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-display font-bold text-white mb-6 leading-tight">
                    Maîtrisez le Soudage par Points
                    <span class="gradient-text">comme un Ingénieur Industriel</span>
                </h1>

                <!-- Subheadline -->
                <p class="text-xl md:text-2xl text-gray-400 mb-12 max-w-3xl mx-auto">
                    Formations techniques 100% PDF par <strong class="text-white">Mang-Ky Ha</strong> — Expert en soudage de batteries lithium pour l'industrie automobile et aéronautique
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="<?php echo e(route('formations.index')); ?>" class="btn btn-primary btn-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Découvrir les Formations
                    </a>
                    <a href="#pack-complet" class="btn btn-secondary btn-lg">
                        Pack Complet -20%
                    </a>
                </div>

                <!-- Trust Indicators -->
                <div class="mt-16 flex flex-wrap items-center justify-center gap-8 text-gray-500">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Téléchargement immédiat</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Accès à vie</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Mises à jour gratuites</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Decorative elements -->
        <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-dark to-transparent"></div>
    </section>

    <!-- Why Different Section -->
    <section class="py-20 bg-dark-lighter">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="section-title">Pourquoi ces Formations sont Différentes</h2>
                <p class="section-subtitle mx-auto">Du savoir industriel documenté, pas des tutoriels approximatifs</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                <!-- What we're NOT -->
                <div class="card p-8">
                    <h3 class="text-xl font-display font-semibold text-accent mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Ce que nous ne sommes PAS
                    </h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3 text-gray-400">
                            <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Des tutoriels YouTube approximatifs
                        </li>
                        <li class="flex items-start gap-3 text-gray-400">
                            <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Des conseils génériques copiés-collés
                        </li>
                        <li class="flex items-start gap-3 text-gray-400">
                            <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            De la théorie sans applications concrètes
                        </li>
                        <li class="flex items-start gap-3 text-gray-400">
                            <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Du contenu sponsorisé par un fabricant
                        </li>
                    </ul>
                </div>

                <!-- What we ARE -->
                <div class="card p-8 border-accent/30">
                    <h3 class="text-xl font-display font-semibold text-green-400 mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Ce que nous sommes
                    </h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3 text-gray-300">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Protocoles industriels réels utilisés en production
                        </li>
                        <li class="flex items-start gap-3 text-gray-300">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Paramètres exacts (courant, temps, force) documentés
                        </li>
                        <li class="flex items-start gap-3 text-gray-300">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Retours d'expérience sur +50 000 soudures analysées
                        </li>
                        <li class="flex items-start gap-3 text-gray-300">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Erreurs coûteuses et comment les éviter
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Formations Section -->
    <section class="py-20" id="formations">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="section-title">Nos Formations</h2>
                <p class="section-subtitle mx-auto">Du débutant sérieux à l'expert industriel, progressez à votre rythme</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <?php $__currentLoopData = $formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card card-hover flex flex-col">
                        <!-- Level Badge -->
                        <div class="p-6 pb-0">
                            <span class="level-badge level-<?php echo e($formation->level); ?>">
                                Niveau <?php echo e($formation->level); ?> - <?php echo e($formation->level_label); ?>

                            </span>
                        </div>

                        <!-- Content -->
                        <div class="p-6 flex-1">
                            <h3 class="text-xl font-display font-semibold text-white mb-2">
                                <?php echo e($formation->name); ?>

                            </h3>
                            <p class="text-gray-400 mb-4"><?php echo e($formation->subtitle); ?></p>
                            <p class="text-sm text-gray-500 mb-6"><?php echo e($formation->short_description); ?></p>

                            <!-- Features -->
                            <ul class="space-y-2 mb-6">
                                <li class="flex items-center gap-2 text-sm text-gray-400">
                                    <svg class="w-4 h-4 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <?php echo e($formation->page_count); ?> pages
                                </li>
                                <li class="flex items-center gap-2 text-sm text-gray-400">
                                    <svg class="w-4 h-4 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    Téléchargement immédiat
                                </li>
                            </ul>
                        </div>

                        <!-- Price & CTA -->
                        <div class="p-6 pt-0 border-t border-gray-800 mt-auto">
                            <div class="flex items-center justify-between mb-4">
                                <div class="price-tag">
                                    <?php if($formation->is_on_sale): ?>
                                        <span class="price-old"><?php echo e($formation->formatted_price); ?></span>
                                    <?php endif; ?>
                                    <span class="price"><?php echo e($formation->formatted_current_price); ?></span>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <a href="<?php echo e(route('formations.show', $formation)); ?>" class="btn btn-secondary flex-1">
                                    Voir détails
                                </a>
                                <form action="<?php echo e(route('cart.add', $formation)); ?>" method="POST" class="flex-1">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-primary w-full">
                                        Ajouter
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <!-- Bundle Section -->
    <section class="py-20 bg-dark-lighter" id="pack-complet">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="card border-accent/50 overflow-hidden">
                    <div class="bg-gradient-to-r from-accent/20 to-accent-orange/20 p-8 text-center">
                        <span class="badge badge-accent mb-4">MEILLEURE OFFRE</span>
                        <h2 class="text-3xl md:text-4xl font-display font-bold text-white mb-2">
                            Pack Complet - 3 Formations
                        </h2>
                        <p class="text-gray-400">
                            Économisez <?php echo e(number_format($bundleRegularPrice - $bundlePrice, 2, ',', ' ')); ?> € avec le pack complet
                        </p>
                    </div>

                    <div class="p-8">
                        <div class="grid md:grid-cols-2 gap-8">
                            <!-- Inclus -->
                            <div>
                                <h3 class="font-display font-semibold text-white mb-4">Ce qui est inclus :</h3>
                                <ul class="space-y-3">
                                    <?php $__currentLoopData = $formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="flex items-center gap-3">
                                            <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span class="text-gray-300"><?php echo e($formation->name); ?></span>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <li class="flex items-center gap-3">
                                        <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="text-gray-300">Mises à jour gratuites à vie</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- Prix -->
                            <div class="text-center md:text-right">
                                <div class="mb-4">
                                    <span class="text-gray-500 line-through text-xl"><?php echo e(number_format($bundleRegularPrice, 2, ',', ' ')); ?> €</span>
                                    <span class="badge badge-accent ml-2">-20%</span>
                                </div>
                                <div class="text-5xl font-display font-bold text-white mb-2">
                                    <?php echo e(number_format($bundlePrice, 2, ',', ' ')); ?> €
                                </div>
                                <p class="text-gray-400 mb-6">Paiement unique</p>

                                <form action="<?php echo e(route('cart.add-bundle')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-primary btn-lg w-full md:w-auto">
                                        Commander le Pack Complet
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Expert Section -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <!-- Image -->
                    <div class="relative">
                        <div class="aspect-square bg-dark-card rounded-2xl overflow-hidden border border-gray-800">
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-dark-lighter to-dark-card">
                                <svg class="w-32 h-32 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        </div>
                        <!-- Stats overlay -->
                        <div class="absolute -bottom-6 -right-6 bg-dark-card border border-gray-700 rounded-xl p-4 shadow-xl">
                            <div class="stat-value text-accent">15+</div>
                            <div class="stat-label">ans d'expérience</div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div>
                        <span class="badge badge-accent mb-4">VOTRE FORMATEUR</span>
                        <h2 class="text-3xl md:text-4xl font-display font-bold text-white mb-6">
                            Mang-Ky Ha
                        </h2>
                        <blockquote class="text-xl text-gray-300 italic mb-6 border-l-4 border-accent pl-4">
                            "J'ai passé 15 ans à souder des batteries pour des constructeurs automobiles que vous connaissez tous. Aujourd'hui, je transmets ce savoir."
                        </blockquote>

                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center gap-3 text-gray-400">
                                <svg class="w-5 h-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Ingénieur procédés - Spécialiste assemblage batteries
                            </li>
                            <li class="flex items-center gap-3 text-gray-400">
                                <svg class="w-5 h-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Ex-industrie automobile (R&D batteries haute performance)
                            </li>
                            <li class="flex items-center gap-3 text-gray-400">
                                <svg class="w-5 h-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                +50 000 soudures analysées et documentées
                            </li>
                            <li class="flex items-center gap-3 text-gray-400">
                                <svg class="w-5 h-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Consultant indépendant depuis 2020
                            </li>
                        </ul>

                        <a href="<?php echo e(route('formateur')); ?>" class="btn btn-secondary">
                            En savoir plus
                            <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-dark-card border-y border-gray-800">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="stat-value">15+</div>
                    <div class="stat-label">Années d'expérience</div>
                </div>
                <div>
                    <div class="stat-value">50k+</div>
                    <div class="stat-label">Soudures analysées</div>
                </div>
                <div>
                    <div class="stat-value">12</div>
                    <div class="stat-label">Programmes véhicules</div>
                </div>
                <div>
                    <div class="stat-value">350+</div>
                    <div class="stat-label">Pages de contenu</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Final -->
    <section class="py-20">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-display font-bold text-white mb-6">
                Prêt à Souder comme un Pro ?
            </h2>
            <p class="text-xl text-gray-400 mb-8 max-w-2xl mx-auto">
                Choisissez votre niveau et commencez aujourd'hui. Téléchargement immédiat après paiement.
            </p>
            <a href="<?php echo e(route('formations.index')); ?>" class="btn btn-primary btn-lg">
                Voir toutes les Formations
            </a>
        </div>
    </section>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $attributes = $__attributesOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__attributesOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $component = $__componentOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__componentOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/pages/home.blade.php ENDPATH**/ ?>