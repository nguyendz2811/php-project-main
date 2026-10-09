@extends('layouts.layoutmaster')

@push('styles')
<style>
.menu-page{max-width:1600px;margin:0 auto;color:#18324f}
.menu-heading{display:flex;align-items:flex-start;justify-content:space-between;gap:18px;margin-bottom:22px}
.menu-title{margin:0 0 6px;font-size:28px;font-weight:750;letter-spacing:-.03em;color:#173d68}
.menu-subtitle{margin:0;color:#6b819b;font-size:14px}
.menu-add,.menu-filter-btn,.menu-reset,.menu-action{display:inline-flex;align-items:center;justify-content:center;gap:7px;min-height:40px;padding:9px 15px;border-radius:9px;font-size:13px;font-weight:650;text-decoration:none;transition:background .16s,border-color .16s,transform .16s;white-space:nowrap}
.menu-add,.menu-filter-btn{background:#247ce5;color:#fff;border:1px solid #247ce5;box-shadow:0 3px 8px #247ce51c}
.menu-add:hover,.menu-filter-btn:hover{background:#1769d2;border-color:#1769d2;color:#fff;transform:translateY(-1px)}
.menu-filter-card{background:#fff;border:1px solid #dce9f7;border-radius:14px;padding:18px;margin-bottom:18px;box-shadow:0 5px 18px #205ea00b}
.menu-filter-grid{display:grid;grid-template-columns:minmax(220px,2fr) minmax(145px,1.2fr) minmax(150px,1.35fr) minmax(135px,1fr);gap:14px}
.menu-field{display:flex;flex-direction:column;gap:7px;min-width:0}
.menu-field label{font-size:13px;font-weight:650;color:#284866}
.menu-field input,.menu-field select{width:100%;min-height:41px;padding:9px 12px;border:1px solid #cdd9e7;border-radius:8px;background:#fff;color:#18324f;font:inherit;font-size:13px;outline:0}
.menu-field input::placeholder{color:#93a5b9}
.menu-field input:focus,.menu-field select:focus{border-color:#69b5ff;box-shadow:0 0 0 3px #39a6f829}
.menu-filter-actions{display:flex;gap:9px;margin-top:15px}
.menu-reset{background:#fff;border:1px solid #cdd9e7;color:#526b84}
.menu-reset:hover{background:#f2f8ff;border-color:#9ecbfa;color:#1769d2}
.menu-alert{padding:11px 14px;border-radius:9px;margin-bottom:15px;font-size:13px}
.menu-alert-success{background:#e8f8ef;border:1px solid #b8e8ca;color:#197448}
.menu-result-line{display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;margin:17px 0 11px;color:#6b819b;font-size:13px}
.menu-result-line strong{color:#173d68}
.menu-table-card{background:#fff;border:1px solid #dce9f7;border-radius:13px;overflow:hidden;box-shadow:0 5px 18px #205ea00b}
.menu-table-scroll{overflow-x:auto}
.menu-table{width:100%;min-width:900px;border-collapse:separate;border-spacing:0;font-size:13px}
.menu-table thead th{padding:14px 13px;background:#eaf4ff!important;color:#24527f!important;border-bottom:1px solid #d5e7fa;text-align:left;font-size:12px;font-weight:750;white-space:nowrap}
.menu-table tbody td{padding:13px;border-bottom:1px solid #e8f0f8;color:#35516e;vertical-align:middle}
.menu-table tbody tr:nth-child(even){background:#f9fcff}
.menu-table tbody tr:hover{background:#eff7ff}
.menu-table tbody tr:last-child td{border-bottom:0}
.menu-sort{color:inherit;text-decoration:none;display:inline-flex;align-items:center;gap:5px}
.menu-sort:hover{color:#1769d2}
.menu-sort-icon{color:#2485e8;font-size:12px}
.menu-id{color:#7a91aa;font-variant-numeric:tabular-nums}
.menu-name{font-weight:700;color:#1e4f83}
.menu-url{display:inline-block;max-width:260px;overflow-wrap:anywhere;padding:4px 7px;background:#f0f7ff;border:1px solid #deebfa;border-radius:6px;color:#47719c;font-size:12px}
.menu-position{display:inline-flex;padding:5px 9px;border-radius:7px;background:#e7f3ff;color:#1b67b6;font-weight:650;font-size:12px}
.menu-status{display:inline-flex;align-items:center;gap:6px;padding:5px 9px;border-radius:999px;font-size:12px;font-weight:700;white-space:nowrap}
.menu-status:before{content:"";width:6px;height:6px;border-radius:50%;background:currentColor}
.menu-status-on{background:#e6f8ee;color:#198754}
.menu-status-off{background:#fff0f0;color:#c14444}
.menu-actions{display:flex;align-items:center;gap:7px}
.menu-action{min-height:32px;padding:6px 10px;border:1px solid #d7e7f8;background:#fff;color:#2765a2;font-size:12px;cursor:pointer}
.menu-action:hover{background:#edf6ff;color:#145db8}
.menu-action-delete{border-color:#f1d1d1;color:#b33c3c}
.menu-action-delete:hover{background:#fff0f0;color:#a52222}
.menu-empty{text-align:center!important;padding:34px 18px!important;color:#7b91a8!important;background:#fbfdff}
.menu-table-footer{display:flex;align-items:center;justify-content:space-between;gap:14px;flex-wrap:wrap;margin-top:16px}
.menu-summary{font-size:13px;color:#6b819b}
.menu-summary strong{color:#173d68}
.menu-pagination .pagination{margin:0;gap:4px}
.menu-pagination .page-link{border-radius:7px!important;border-color:#dce9f7;color:#286bb4}
.menu-pagination .active .page-link{background:#247ce5;border-color:#247ce5;color:white}
.menu-pagination .disabled .page-link{color:#a6b5c5}
@media(max-width:1050px){.menu-filter-grid{grid-template-columns:repeat(2,minmax(0,1fr))}}
@media(max-width:620px){.menu-heading{flex-direction:column}.menu-filter-grid{grid-template-columns:1fr}.menu-filter-actions{flex-direction:column}.menu-filter-actions>*{width:100%}.menu-title{font-size:24px}}
</style>
@endpush

@section('content')
@php
    $sortUrl = function (string $column) use ($sortBy, $sortDir) {
        return request()->fullUrlWithQuery([
            'sort_by' => $column,
            'sort_dir' => ($sortBy === $column && $sortDir === 'asc') ? 'desc' : 'asc',
            'page' => 1,
        ]);
    };
    $sortLabel = fn (string $column) => $sortBy === $column ? ($sortDir === 'asc' ? '▲' : '▼') : '↕';
@endphp

<section class="menu-page">
    <div class="menu-heading">
        <div>
            <h1 class="menu-title">Quản lý Menu</h1>
            <p class="menu-subtitle">Tìm kiếm, lọc, sắp xếp và quản lý các mục menu trong hệ thống.</p>
        </div>
        <a href="{{ route('menu.create') }}" class="menu-add">＋ Thêm menu</a>
    </div>

    @if(session('success'))
        <div class="menu-alert menu-alert-success">{{ session('success') }}</div>
    @endif

    <section class="menu-filter-card" aria-label="Bộ lọc menu">
        <form method="GET" action="{{ route('menu.index') }}">
            <div class="menu-filter-grid">
                <div class="menu-field">
                    <label for="menu-search">Từ khóa</label>
                    <input id="menu-search" type="search" name="search" value="{{ request('search') }}" placeholder="Tên menu, đường dẫn, nhóm...">
                </div>
                <div class="menu-field">
                    <label for="menu-position">Vị trí</label>
                    <select id="menu-position" name="vi_tri">
                        <option value="">Tất cả</option>
                        @foreach ($viTriOptions as $key => $label)
                            <option value="{{ $key }}" {{ request('vi_tri') === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="menu-field">
                    <label for="menu-status">Trạng thái</label>
                    <select id="menu-status" name="trang_thai">
                        <option value="">Tất cả</option>
                        <option value="1" {{ request('trang_thai') === '1' ? 'selected' : '' }}>Hiển thị</option>
                        <option value="0" {{ request('trang_thai') === '0' ? 'selected' : '' }}>Ẩn</option>
                    </select>
                </div>
                <div class="menu-field">
                    <label for="menu-per-page">Số dòng / trang</label>
                    <select id="menu-per-page" name="per_page">
                        @foreach ([10, 25, 50, 100] as $size)
                            <option value="{{ $size }}" {{ (int) $perPage === $size ? 'selected' : '' }}>{{ $size }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <input type="hidden" name="sort_by" value="{{ $sortBy }}">
            <input type="hidden" name="sort_dir" value="{{ $sortDir }}">
            <div class="menu-filter-actions">
                <button type="submit" class="menu-filter-btn">Lọc</button>
                <a href="{{ route('menu.index') }}" class="menu-reset">Xóa lọc</a>
            </div>
        </form>
    </section>

    <div class="menu-result-line">
        <span>Tìm thấy <strong>{{ $menus->total() }}</strong> menu</span>
        @if(request()->hasAny(['search', 'vi_tri', 'trang_thai']))
            <span>Đang áp dụng bộ lọc</span>
        @endif
    </div>

    <section class="menu-table-card" aria-label="Danh sách menu">
        <div class="menu-table-scroll">
            <table class="menu-table">
                <thead><tr>
                    <th><a class="menu-sort" href="{{ $sortUrl('id') }}">ID <span class="menu-sort-icon">{{ $sortLabel('id') }}</span></a></th>
                    <th><a class="menu-sort" href="{{ $sortUrl('ten') }}">Tên menu <span class="menu-sort-icon">{{ $sortLabel('ten') }}</span></a></th>
                    <th><a class="menu-sort" href="{{ $sortUrl('url') }}">Đường dẫn <span class="menu-sort-icon">{{ $sortLabel('url') }}</span></a></th>
                    <th><a class="menu-sort" href="{{ $sortUrl('vi_tri') }}">Vị trí <span class="menu-sort-icon">{{ $sortLabel('vi_tri') }}</span></a></th>
                    <th><a class="menu-sort" href="{{ $sortUrl('nhom') }}">Nhóm <span class="menu-sort-icon">{{ $sortLabel('nhom') }}</span></a></th>
                    <th><a class="menu-sort" href="{{ $sortUrl('thu_tu') }}">Thứ tự <span class="menu-sort-icon">{{ $sortLabel('thu_tu') }}</span></a></th>
                    <th><a class="menu-sort" href="{{ $sortUrl('trang_thai') }}">Trạng thái <span class="menu-sort-icon">{{ $sortLabel('trang_thai') }}</span></a></th>
                    <th>Thao tác</th>
                </tr></thead>
                <tbody>
                @forelse ($menus as $menu)
                    <tr>
                        <td class="menu-id">{{ $menu->id }}</td>
                        <td class="menu-name">{{ $menu->ten }}</td>
                        <td><span class="menu-url">{{ $menu->url }}</span></td>
                        <td><span class="menu-position">{{ $viTriOptions[strtolower($menu->vi_tri)] ?? $menu->vi_tri }}</span></td>
                        <td>{{ $menu->nhom ?: '—' }}</td>
                        <td>{{ $menu->thu_tu }}</td>
                        <td><span class="menu-status {{ $menu->trang_thai ? 'menu-status-on' : 'menu-status-off' }}">{{ $menu->trang_thai ? 'Hiển thị' : 'Ẩn' }}</span></td>
                        <td>
                            <div class="menu-actions">
                                <a href="{{ route('menu.edit', $menu->id) }}" class="menu-action">Sửa</a>
                                <form action="{{ route('menu.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa menu này không?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="menu-action menu-action-delete">Xóa</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="menu-empty">Không có menu nào phù hợp với điều kiện tìm kiếm.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <div class="menu-table-footer">
        <div class="menu-summary">Hiển thị <strong>{{ $menus->firstItem() ?? 0 }}–{{ $menus->lastItem() ?? 0 }}</strong> trong tổng số <strong>{{ $menus->total() }}</strong> menu</div>
        <div class="menu-pagination">{{ $menus->links() }}</div>
    </div>
</section>
@endsection
