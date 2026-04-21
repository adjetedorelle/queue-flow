@extends('layouts.frontend')
@section('content')
    <!-- Hero Section -->
    <section class="relative overflow-hidden pt-12 pb-24 px-6">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-12 items-center">
            <div class="z-10">
                <span
                    class="inline-block px-4 py-1.5 rounded-full bg-[#002B5B] text-[#FFFFFF] text-xs font-bold uppercase tracking-widest mb-6">
                    L'attente réinventée
                </span>
                <h1 class="font-headline text-5xl md:text-6xl font-extrabold text-primary leading-[1.1] mb-6">
                    Réduisez vos temps d'attente grâce à une gestion intelligente des files d'attente
                </h1>
                <p class="text-lg text-on-surface-variant mb-10 max-w-xl">
                    Prenez vos tickets à distance et suivez votre tour en temps réel. Libérez-vous des files d'attente
                    physiques et optimisez votre journée.
                </p>
            </div>
            <div class="relative">
                <div class="absolute -top-12 -right-12 w-64 h-64 bg-tertiary-fixed/30 rounded-full blur-3xl"></div>
                <div
                   class="relative rounded-[2rem] overflow-hidden shadow-2xl">
                    <img class="w-full h-[600px] object-cover"
                           src="{{ asset('images/image_acceuil.jpeg') }}"
                         alt="Description de ton image" />
                    <div class="absolute bottom-2 left-6 right-6 glass-nav p-4 rounded-2xl shadow-xl">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-bold text-primary">Votre Position</span>
                            <span class="text-xs text-on-surface-variant">Ticket #A242</span>
                        </div>
                        <div class="text-3xl font-black text-primary font-headline">N° 3 <span
                                class="text-sm font-medium text-on-surface-variant">sur 14</span></div>
                        <div class="mt-4 h-2 w-full bg-surface-container rounded-full overflow-hidden">
                            <div class="h-full bg-[#FF6B00] w-[75%] rounded-full"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Benefits Section -->
    <section class="bg-surface-container-low py-24 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="font-headline text-4xl font-extrabold text-primary mb-4">Pourquoi choisir QueueFlow ?</h2>
                <p class="text-on-surface-variant max-w-2xl mx-auto italic">Une expérience fluide pour les clients et une
                    organisation optimale pour les entreprises.</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-12">
                <!-- Card 1 -->
                <div
                    class="bg-surface-container-lowest p-8 rounded-[1.5rem] shadow-sm hover:shadow-lg transition-all group lg:-translate-y-4">
                    <div
                        class="w-14 h-14 bg-[#FFE3CC] rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#FF6B00] transition-colors">
                        <span class="material-symbols-outlined text-[#FF6B00] group-hover:text-white"
                            data-icon="schedule">schedule</span>
                    </div>
                    <h3 class="font-headline text-xl font-bold text-primary mb-3">Gain de temps</h3>
                    <p class="text-sm text-on-surface-variant leading-relaxed">Évitez les attentes inutiles et planifiez
                        votre arrivée précisément quand c'est votre tour.</p>
                </div>
                <!-- Card 2 -->
                <div
                    class="bg-surface-container-lowest p-8 rounded-[1.5rem] shadow-sm hover:shadow-lg transition-all group lg:translate-y-4">
                    <div
                        class="w-14 h-14 bg-[#FFE3CC] rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#FF6B00] transition-colors">
                        <span class="material-symbols-outlined text-[#FF6B00] group-hover:text-white"
                            data-icon="update">update</span>
                    </div>
                    <h3 class="font-headline text-xl font-bold text-primary mb-3">Suivi en temps réel</h3>
                    <p class="text-sm text-on-surface-variant leading-relaxed">Consultez votre position dans la file et le
                        temps d'attente estimé depuis votre mobile.</p>
                </div>
                <!-- Card 3 -->
                <div
                    class="bg-surface-container-lowest p-8 rounded-[1.5rem] shadow-sm hover:shadow-lg transition-all group lg:-translate-y-4">
                    <div
                        class="w-14 h-14 bg-[#FFE3CC] rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#FF6B00] transition-colors">
                        <span class="material-symbols-outlined text-[#FF6B00] group-hover:text-white"
                            data-icon="groups">groups</span>
                    </div>
                    <h3 class="font-headline text-xl font-bold text-primary mb-3">Moins de foule</h3>
                    <p class="text-sm text-on-surface-variant leading-relaxed">Réduisez l'encombrement physique dans vos
                        locaux pour un environnement plus sain.</p>
                </div>
                <!-- Card 4 -->
                <div
                    class="bg-surface-container-lowest p-8 rounded-[1.5rem] shadow-sm hover:shadow-lg transition-all group lg:translate-y-4">
                    <div
                        class="w-14 h-14 bg-[#FFE3CC] rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#FF6B00] transition-colors">
                        <span class="material-symbols-outlined text-[#FF6B00] group-hover:text-white"
                            data-icon="assignment_turned_in">assignment_turned_in</span>
                    </div>
                    <h3 class="font-headline text-xl font-bold text-primary mb-3">Organisation</h3>
                    <p class="text-sm text-on-surface-variant leading-relaxed">Améliorez l'efficacité de vos équipes grâce à
                        une gestion structurée des flux.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Business Types Bento Grid -->
    <section class="py-24 px-6 bg-surface">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-4">
                <div class="max-w-xl">
                    <h2 class="font-headline text-4xl font-extrabold text-primary mb-4">Adapté à tous les secteurs</h2>
                    <p class="text-on-surface-variant">QueueFlow s'intègre parfaitement dans tout établissement recevant du
                        public, quelle que soit sa taille.</p>
                </div>
                
            </div>
            <div class="grid grid-cols-1 md:grid-cols-6 gap-6">
                <div class="md:col-span-2 relative rounded-[2rem] overflow-hidden group h-[350px]">
                    <img alt="bank interior"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuD0X5VA3fLvPAvKNiudchqhYtJrQSan5iwhezoRTYx-9wX0RyjO4YFxynH01MoWYfEF5NBd93O2k48DCX2qeFtBJ_z_tnbrdzF_t689hLSdmXfbjZgFUiL8zO4vevkU7BMUFKtw893Hmr1BcUaXQwAq6lPPcxzYJJ7uYOBbE4xXfe__9FJ3Q6pjajyQvlaUKQBiJXgoWhHFeKwiQ8UrslJ1SvFaopDWoLYjcyU3U0A0EAO0EhKFETt3b0GwxjfAzbCCsGFzPANYWD8" />
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/90 to-transparent"></div>
                    <div class="absolute bottom-8 left-8">
                        <h4 class="text-white text-2xl font-black font-headline">Secteurs bancaires</h4>
                        <p class="text-primary-fixed-dim mt-2">Gestion des flux financiers.</p>
                    </div>
                </div>
                <div class="md:col-span-2 relative rounded-[2rem] overflow-hidden group h-[350px]">
                    <img alt="government administration building"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBDQk6uSSXiuByRXPywnQHqs7G01HAxdy7LkE40JAlP_cjuAyvrCzCsOwjZU0U6knPc6JnsJ8LDwgo5btjz-z-p4cZOBh1-uOajdMl_gkvNXeRi_1p4oGYQjvjzl35LB64bhCj25o53Knd_pz2FMEjR9bEjYFae2Kxw-1GLLMc3dETYEfTj9BRTTIqa2GdZX-J3nDJLMjZmbmvA7tW9PC-vk85sXLFJqcopenJvcqa76DlsAoYnbU_lYzzvb8mo48iPJga7hTvJVcE" />
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/90 to-transparent"></div>
                    <div class="absolute bottom-8 left-8">
                        <h4 class="text-white text-2xl font-black font-headline">Secteurs publiques</h4>
                        <p class="text-primary-fixed-dim mt-2">Mairies et services d'état.</p>
                    </div>
                </div>
                <div class="md:col-span-2 relative rounded-[2rem] overflow-hidden group h-[350px]">
                    <img alt="modern telecommunications office with customer service desks and digital queue screens"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80" />
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/90 to-transparent"></div>
                    <div class="absolute bottom-8 left-8">
                        <h4 class="text-white text-2xl font-black font-headline">Secteurs télécoms</h4>
                        <p class="text-primary-fixed-dim mt-2">Agences et centres d'appels.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Stats Section (Bento Style) -->
    <section class="bg-surface-container-low py-16 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-surface-container-lowest p-8 rounded-lg shadow-sm border-l-4 border-secondary-container">
                    <div class="text-sm font-bold text-secondary uppercase tracking-widest mb-2">Impact Global</div>
                    <div class="text-4xl font-black text-primary mb-1">500+</div>
                    <p class="text-on-surface-variant font-medium">Entreprises inscrites</p>
                </div>
                <div class="bg-surface-container-lowest p-8 rounded-lg shadow-sm border-l-4 border-[#FF6B00]">
                    <div class="text-sm font-bold text-[#FF6B00] uppercase tracking-widest mb-2">Flux de Données</div>
                    <div class="text-4xl font-black text-primary mb-1">1.2M+</div>
                    <p class="text-on-surface-variant font-medium">Tickets générés</p>
                </div>
                <div class="bg-surface-container-lowest p-8 rounded-lg shadow-sm border-l-4 border-primary-container">
                    <div class="text-sm font-bold text-primary-container uppercase tracking-widest mb-2">Satisfaction</div>
                    <div class="text-4xl font-black text-primary mb-1">98%</div>
                    <p class="text-on-surface-variant font-medium">Clients servis avec succès</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonials -->
    <section class="py-24 px-6 bg-surface-container-low">
        <div class="max-w-7xl mx-auto">
            <h2 class="font-headline text-4xl font-extrabold text-primary text-center mb-16">Ils nous font confiance</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-3xl shadow-sm relative">
                    <div class="text-tertiary mb-4">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    </div>
                    <p class="text-on-surface mb-8 italic leading-relaxed">"Depuis l'installation de QueueFlow, nos clients
                        sont beaucoup plus détendus. Ils arrivent pile au bon moment."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-surface-container overflow-hidden">
                            <img class="w-full h-full object-cover"
                                data-alt="portrait of a professional male manager in a business suit with a friendly smile"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBHOR8BOedAC6B7bJ65SnoetkibytrVVkedfxhEzbyg422-aJSfDvf311glZujT7aHEeb2UNaNZpwKtnEmyPmS0YLYaj3TcSoKh0YO2Fl0XwZqR33iryJ3kbjRDwLXVB6P4HomJVUrpjHL2epntSUQZ0-0XcAc_5fv5gV03NoMTUvTOsDhoRWDS5R4evB76Witb11kGqvutALb0mAjsbfiWVQeeWi1-qn-1rrG4O8IpwhqGnI-mUCHHFYO92dkiy8DOSyGLPOY0jnU" />
                        </div>
                        <div>
                            <div class="font-bold text-primary"> Mr Jean CODJO</div>
                            <div class="text-xs text-on-surface-variant">Dir. Banque Centrale</div>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-sm relative border-t-4 border-[#FF6B00]">
                    <div class="text-tertiary mb-4">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    </div>
                    <p class="text-on-surface mb-8 italic leading-relaxed">"Un outil indispensable pour notre secrétariat
                        universitaire. La gestion des pics de fin d'année est devenue un jeu d'enfant."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-surface-container overflow-hidden">
                            <img class="w-full h-full object-cover"
                                data-alt="close-up portrait of a professional woman with glasses and a warm smile"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBCIIN-XujVrnOHt5mbxKDA9d8kjg3DlFbnotxuySurh7DgU5er5E-GgUkV9oNoii9osguCdj4kPK4nKori4HcBfE7Ad-kvhtqIXTKsPhB4vZz7h7nGgU6TR-mwIHp20nkozrP8O4ZFBpyNm3GiuOl8op5qYd3pY2EWsGJdVOY0v0bs25rZo7ikgP9pO8mWhNZuUAdw7u5PMx7LaKAE8tOqK1Iu9DdnKaVBul2JGHUn73vkr5KlHgzJ69JHc_jnSw6JRJ-1_mWcnPM" />
                        </div>
                        <div>
                            <div class="font-bold text-primary"> Mme Marie DOSSOU</div>
                            <div class="text-xs text-on-surface-variant">Responsable Académique</div>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-sm relative">
                    <div class="text-tertiary mb-4">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    </div>
                    <p class="text-on-surface mb-8 italic leading-relaxed">“Une vraie amélioration dans la gestion de nos usagers. Ils n’ont plus besoin de faire
                         la queue physiquement, ils peuvent patienter librement et être appelés à distance.”</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-surface-container overflow-hidden">
                            <img class="w-full h-full object-cover"
                                data-alt="headshot of a mature male doctor in professional medical attire"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDqYZv4Q1POEiuZiTH1g4gfBYXApapWomuelv9YCO4efcYLZoXkMxqVche7R6GuMgUQHmiYcaGwWRAOwPsVphxoTAQrHt2NQBGyox06vSoD4RdMYDagI_rlRcArjMOSk60r-ptQgaykkHCP9oURpSHXNivTCeFcd63W9e2lO_VGMI12BHxrX24lo1_xeZAfz7aQwS9ydYS1ZCn6iSCdF6xB8ggPRRUCZ1H5rKBbARI1hde2KEC_NKj8fQ2wIzyTnNb44VlUEwIN38w" />
                        </div>
                        <div>
                            <div class="font-bold text-primary">Mr Francis Koutouan</div>
                            <div class="text-xs text-on-surface-variant">Responsable du service accueil – Mairie de service public </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FAQ Section -->
    <section class="py-24 px-6 bg-surface">
        <div class="max-w-3xl mx-auto">
            <h2 class="font-headline text-4xl font-extrabold text-primary text-center mb-16">Questions Fréquentes</h2>
            <div class="space-y-4">
                <div class="bg-surface-container-low rounded-2xl p-6 transition-all hover:bg-surface-container">
                    <button class="flex justify-between items-center w-full text-left font-bold text-primary">
                        <span>Comment prendre un ticket à distance ?</span>
                        <span class="material-symbols-outlined text-outline">expand_more</span>
                    </button>
                    <p class="mt-4 text-sm text-on-surface-variant leading-relaxed">Il vous suffit de rechercher
                        l'entreprise sur notre application, de choisir le service souhaité et de cliquer sur "Prendre un
                        ticket". Vous recevrez une confirmation instantanée.</p>
                </div>
                <div class="bg-surface-container-low rounded-2xl p-6 transition-all hover:bg-surface-container">
                    <button class="flex justify-between items-center w-full text-left font-bold text-primary">
                        <span>L'application est-elle gratuite pour les clients ?</span>
                        <span class="material-symbols-outlined text-outline">expand_more</span>
                    </button>
                    <p class="mt-4 text-sm text-on-surface-variant leading-relaxed">l’utilisation de la plateforme est entièrement gratuite pour les clients. Vous pouvez consulter les 
                        entreprises disponibles, choisir un service et prendre un ticket sans aucun frais. Notre objectif 
                        est de vous offrir une expérience simple, rapide et accessible, afin de réduire votre temps d’attente
                         et faciliter vos démarches au quotidien.</p>
                </div>
                <div class="bg-surface-container-low rounded-2xl p-6 transition-all hover:bg-surface-container">
                    <button class="flex justify-between items-center w-full text-left font-bold text-primary">
                        <span>Puis-je annuler mon ticket ?</span>
                        <span class="material-symbols-outlined text-outline">expand_more</span>
                    </button>
                    <p class="mt-4 text-sm text-on-surface-variant leading-relaxed">Oui, vous avez la possibilité d’annuler votre ticket à tout moment tant qu’il n’a pas encore été appelé ou traité. Cette option vous permet de libérer votre place
                         dans la file d’attente si vous n’êtes plus disponible, afin de mieux organiser le passage des autres clients.</p>
                </div>
                <div class="bg-surface-container-low rounded-2xl p-6 transition-all hover:bg-surface-container">
                    <button class="flex justify-between items-center w-full text-left font-bold text-primary">
                        <span>Quelles entreprises utilisent QueueFlow ?</span>
                        <span class="material-symbols-outlined text-outline">expand_more</span>
                    </button>
                    <p class="mt-4 text-sm text-on-surface-variant leading-relaxed">QueueFlow est utilisé par plusieurs types d’entreprises comme les banques, les administrations, les universités ou encore les centres de services. Notre objectif est d’aider ces structures à mieux organiser leurs files d’attente et à offrir une expérience 
                        plus rapide et fluide à leurs clients.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
