{{-- resources/views/partials/sidebar.blade.php --}}
@push('styles')
<style>
    aside{
        grid-area:sidebar; background:#EAF4FF; padding:24px 13px; border-right:1px solid #D7E8FA;
        display:flex; flex-direction:column; gap:24px; overflow-y:auto;
    }
    .nav-group-label{
        font-size:10.5px; letter-spacing:.14em; text-transform:uppercase;
        color:#7792B2; padding:0 12px; margin-bottom:9px; font-weight:600;
    }
    .nav-list{ list-style:none; display:flex; flex-direction:column; gap:3px; }
    .nav-list a{
        display:flex; align-items:center; gap:12px; padding:10px 12px; border-radius:8px;
        text-decoration:none; color:#476789; font-size:13.5px; font-weight:500;
        transition:background .15s ease, color .15s ease;
    }
    .nav-list a:hover{ background:#D8ECFF; color:#145DB8; }
    .nav-list a.active{ background:#D5EAFE; color:#1769D2; box-shadow:inset 3px 0 0 #2485E8; }
    .nav-list a .icon{ width:17px; height:17px; flex-shrink:0; display:flex; align-items:center; justify-content:center; }
    .nav-list a .count{ margin-left:auto; font-family:'JetBrains Mono', monospace; font-size:10.5px; color:#7792B2; }
    .nav-list a.active .count{ color:#1769D2; }
    .sidebar-divider{
        margin-top:auto; padding:14px 12px; border-top:1px solid #D2E4F7;
        font-size:11px; color:#7792B2; line-height:1.5;
    }

    @media (max-width: 860px){
        aside{ display:none; }
    }
</style>
@endpush

<aside>
    <nav>
        <div class="nav-group-label">Tổng quan</div>
        <ul class="nav-list">
            <li><a href="#" class="active">
                <span class="icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>
                </span>
                Dashboard
            </a></li>
        </ul>
    </nav>

    <nav>
        <div class="nav-group-label">Học vụ</div>
        <ul class="nav-list">
            <li><a href="{{ route('sinhvien.index') }}">
                <span class="icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21v-1a8 8 0 0 1 16 0v1"/></svg>
                </span>
                Sinh viên <span class="count">3</span>
            </a></li>
            <li><a href="{{ url('/lophoc') }}">
                <span class="icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                </span>
                Lớp học
            </a></li>
            
        </ul>
    </nav>

    <nav>
        <div class="nav-group-label">Hệ thống</div>
        <ul class="nav-list">
            <li><a href="{{ route('menu.index') }}">
                <span class="icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </span>
                Menu
            </a></li>
            
        </ul>
    </nav>

    <div class="sidebar-divider">
        Học kỳ 1 · Năm học 2026–2027
    </div>
</aside>

@push('styles')
<style>
aside .nav-group-label{font-size:10px;letter-spacing:.12em;color:#7C96B5;}
aside .nav-list a{border-radius:10px;padding:11px 12px;color:#426383;}
aside .nav-list a:hover{background:#DCEEFF;color:#145DB8;}
aside .nav-list a.active{background:#D5EAFE;color:#1769D2;box-shadow:inset 3px 0 0 #2485E8;}
aside .nav-list a.active .count{color:#1769D2;}
aside .sidebar-divider{color:#7792B2;}
</style>
@endpush
