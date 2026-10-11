{{-- resources/views/partials/header.blade.php --}}
@push('styles')
<style>
    header{
        grid-area:header;
        display:flex;
        align-items:center;
        justify-content:space-between;
        padding:0 clamp(14px, 2.2vw, 30px);
        background:var(--navy);
        border-bottom:3px solid #8CCBFF; box-shadow:0 3px 12px rgba(20,80,150,.08);
    }
    .brand{ display:flex; align-items:center; gap:12px; color:#FFFFFF; }
    .brand-mark{
        width:34px; height:34px; border-radius:50%;
        background:#D8ECFF;
        display:flex; align-items:center; justify-content:center;
        font-family:'Fraunces', serif; font-weight:700; font-size:15px; color:#1769D2;
    }
    .brand-text .title{ font-family:'Fraunces', serif; font-weight:700; font-size:17px; letter-spacing:.01em; }
    .brand-text .sub{ font-size:11px; color:#CDE4FF; letter-spacing:.06em; text-transform:uppercase; }

    .header-search{ flex:1; max-width:400px; margin:0 32px; position:relative; }
    .header-search input{
        width:100%; background:#214F91; border:1px solid #4C79B8;
        border-radius:8px; padding:9px 12px 9px 34px; color:#FFFFFF; font-size:13px;
        outline:none; transition:border-color .15s ease;
    }
    .header-search input:focus{ border-color:#8CCBFF; }
    .header-search input::placeholder{ color:#7A85AB; }
    .header-search svg{ position:absolute; left:11px; top:50%; transform:translateY(-50%); stroke:#B7D8FF; }

    .header-user{ display:flex; align-items:center; gap:10px; padding-left:20px; border-left:1px solid #41669D; }
    .avatar{
        width:34px; height:34px; border-radius:50%; background:#214F91; border:1px solid #8CCBFF;
        display:flex; align-items:center; justify-content:center;
        font-family:'Fraunces', serif; font-size:13px; font-weight:700; color:#BDE2FF;
    }
    .header-user .name{ font-size:13px; font-weight:600; color:#FFFFFF; }
    .header-user .role{ font-size:11px; color:#CDE4FF; }
</style>
@endpush

<header>
    <div class="brand">
        <div class="brand-mark">H</div>
        <div class="brand-text">
            <div class="title">HUCE.Web</div>
            <div class="sub">QUẢN LÝ SINH VIÊN</div>
        </div>
    </div>

    <div class="header-search">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke-width="2">
            <circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <input type="text" placeholder="Tìm sinh viên, lớp học, mã số...">
    </div>

    <div class="header-user">
        <div class="avatar">AD</div>
        <div>
            <div class="name">ADMIN</div>
            <div class="role">Quản trị viên</div>
        </div>
    </div>
</header>

@push('styles')
<style>
@media(max-width:650px){
  header{padding:0 14px; gap:12px;}
  .brand{gap:8px; min-width:0;}
  .brand-text .title{font-size:14px;}
  .brand-text .sub{font-size:9px;}
  .header-search{margin:0; max-width:none; flex:1;}
  .header-search input{font-size:12px;}
  .header-user{padding-left:10px; gap:7px;}
  .header-user .role{display:none;}
}
@media(max-width:440px){.brand-text .sub{display:none;}.header-user .name{font-size:11px;}}
</style>
@endpush
