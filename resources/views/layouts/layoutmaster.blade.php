<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $title ?? 'Quản lý Sinh viên' }}</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
  /* ===== Biến dùng chung cho toàn bộ layout ===== */
  :root{
    --navy:          #1769D2;
    --navy-2:        #1257B5;
    --navy-border:   #D7E7FB;
    --gold:          #39A6F8;
    --gold-dim:      #E5F2FF;
    --paper:         #F3F8FE;
    --paper-2:       #EAF3FD;
    --ink:           #18324F;
    --ink-muted:     #6B819B;
    --line:          #DCE9F7;
    --radius:        14px;
  }

  *{ box-sizing:border-box; margin:0; padding:0; }

  /* ===== Khung grid tổng thể của trang ===== */
  body{
    background:var(--paper);
    color:var(--ink);
    font-family:'Inter', sans-serif;
    min-height:100vh;
    display:grid;
    grid-template-rows:72px minmax(0, 1fr) 44px;
    grid-template-columns:238px minmax(0, 1fr);
    grid-template-areas:
      "header header"
      "sidebar main"
      "footer footer";
  }

  h1, h2, .serif{ font-family:'Fraunces', serif; }
  .mono{ font-family:'JetBrains Mono', monospace; }

  /* ===== Style cho vùng nội dung chính (main) ===== */
  main{ grid-area:main; padding:30px clamp(18px, 3vw, 42px); overflow-y:auto; min-width:0; }
  main > * { animation: pageEnter .22s ease-out; }
  @keyframes pageEnter { from { opacity:.65; transform:translateY(4px); } to { opacity:1; transform:translateY(0); } }
  /* Bộ quy tắc giao diện chung cho các trang danh sách */
  .page-title, .page-sub, .student-title, .list-title { letter-spacing:-.025em; }
  .page-title, .student-title, .list-title { color:var(--ink); }
  .student-filter-card, .student-table-card, .filter-card, .table-card {
    border-color:var(--line) !important; border-radius:14px !important;
    box-shadow:0 5px 18px rgba(32, 94, 160, .045);
  }
  .student-table th, .data-table th {
    background:#EAF4FF !important; color:#24527F !important;
    border-bottom:1px solid #D6E8FC !important;
  }
  .student-table td, .data-table td { border-bottom-color:#EAF0F7 !important; }
  .student-table tbody tr:nth-child(even), .data-table tbody tr:nth-child(even) { background:#F8FBFF; }
  .student-table tbody tr:hover, .data-table tbody tr:hover { background:#EDF6FF !important; }
  .student-add, .student-filter-button, .primary-link, .filter-button, .btn-filter, .btn-add {
    background:#247CE5 !important; border-color:#247CE5 !important; color:#fff !important;
    border-radius:9px !important; box-shadow:0 3px 8px rgba(36,124,229,.14);
  }
  .student-add:hover, .student-filter-button:hover, .primary-link:hover, .filter-button:hover, .btn-filter:hover, .btn-add:hover {
    background:#1769D2 !important; border-color:#1769D2 !important; transform:translateY(-1px);
  }
  .student-field input:focus, .student-field select:focus, .field input:focus, .field select:focus,
  .filter-form input:focus, .filter-form select:focus {
    border-color:#69B5FF !important; box-shadow:0 0 0 3px rgba(57,166,248,.16) !important;
  }
  .student-sort-arrow, .sort-arrow { color:#2485E8 !important; }
  .student-code, .student-name, .class-name { color:#1769D2 !important; }
  .student-reset, .reset-link, .btn-reset, .action-link, .student-edit {
    border-radius:8px !important; border-color:#D7E7F8 !important;
  }
  .student-empty, .empty-state { background:#F8FBFF; }
  /* Trang Menu có bảng dùng selector chung */
  main table:not(.student-table):not(.data-table) { border-collapse:separate; border-spacing:0; overflow:hidden; border-radius:12px; background:#fff; }
  main table:not(.student-table):not(.data-table) th { background:#EAF4FF !important; color:#24527F !important; }
  main table:not(.student-table):not(.data-table) th,
  main table:not(.student-table):not(.data-table) td { border-bottom:1px solid #E5EEF8; }
  main table:not(.student-table):not(.data-table) tbody tr:hover { background:#F0F7FF; }
  @media (max-width:860px) { main { padding:22px 16px; } }
  @media (max-width:520px) { main { padding:16px 12px; } }
  .page-title{ font-family:'Fraunces', serif; font-size:26px; font-weight:700; margin-bottom:6px; }
  .page-sub{ color:var(--ink-muted); font-size:13.5px; margin-bottom:26px; }
  .placeholder-box{
    border:1px dashed var(--line); background:var(--paper-2); border-radius:var(--radius);
    padding:44px 24px; text-align:center; color:var(--ink-muted); font-size:13.5px;
  }
  .placeholder-box code{
    display:inline-block; margin-top:10px; background:#fff; border:1px solid var(--line);
    padding:4px 10px; border-radius:6px; font-size:12px; color:var(--navy);
  }

  @media (max-width: 860px){
    body{ grid-template-columns:1fr; grid-template-areas: "header" "main" "footer"; }
  }
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body>

    @include('partials.header')
    @include('partials.sidebar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('styles')
    @stack('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: "toast-top-right",
        timeOut: 3500,
    };

    @if (session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if (session('error'))
        toastr.error("{{ session('error') }}");
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>

@stack('scripts')

</body>
</html>