<header
    class="sticky top-0 z-40 w-full dark:bg-[]/80 backdrop-blur-xl flex justify-between items-center px-8 py-4 shadow-sm shadow-slate-200/50">
    <div class="flex items-center gap-4">
        <button class="md:hidden p-2 text-on-surface">
            <span class="material-symbols-outlined" data-icon="menu">menu</span>
        </button>
        <h1 class="text-xl font-bold text-[#223243] font-headline">Dashboard</h1>
    </div>
    <div class="flex items-center gap-6">
        <div class="relative hidden sm:block">
            
        </div>
        <div class="flex items-center gap-2">
            
        </div>
        <div class="h-8 w-[1px] bg-slate-200"></div>
        <div class="flex items-center gap-3 cursor-pointer group">
            <div class="text-right hidden sm:block">
                <p class="text-sm font-semibold text-on-surface leading-none">{{ auth()->user()->nom }}
                    {{ auth()->user()->prenom }} </p>
                <p class="text-[10px] text-on-surface-variant font-medium uppercase tracking-tighter">
                    {{ auth()->user()->role }}</p>
            </div>
            <img alt="User Avatar"
                class="w-10 h-10 rounded-full border-2 border-primary/10 group-hover:border-primary transition-all object-cover"
                data-alt="portrait of a professional man in a sharp navy suit looking confident and approachable with soft office lighting"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDybRIsTyErbDVHfqK0A-JZq9PQwCjzVKW_PUYpK9jxRqBnzYJYab05HRW64S73m5A9WGne4JTPUzb9-7aCL_BBmNTVbCIxkk-NdCpYqktrU9CE3HeK0KcbfbEAvQufcZi455G4wk-kx0BUAZ1huXYUKzZdJp553HfowzfZUsnxINROjLe_TtMs5GPXnxrvsTNHAgEZ5WQab6rZez2kg5x8CILN5tyO_ykQZMMg_MN7sDfp-8OeeYneVDls3SlpQUwEyfG1-ChPMdU" />
        </div>
    </div>
</header>












{{-- <header class="bg-white shadow px-8 py-4 flex justify-between items-center">

    <h1 class="text-xl font-bold">Dashboard</h1>

    <div class="flex items-center gap-4">

        <span class="material-symbols-outlined">notifications</span>

        <div class="flex items-center gap-2">
            <span>{{ auth()->user()->name }}</span>
        </div>

    </div>

</header> --}}
