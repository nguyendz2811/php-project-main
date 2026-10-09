@extends('layouts.layoutmaster')

@push('styles')
<style>
.menu-form-page{max-width:900px;margin:0 auto}.menu-form-card{background:#fff;border:1px solid #dce9f7;border-radius:14px;padding:24px;box-shadow:0 5px 18px #205ea00b}
.menu-form-title{font-size:27px;color:#173d68;font-weight:750;margin:0 0 6px}.menu-form-subtitle{color:#6b819b;margin:0 0 22px;font-size:14px}
.menu-form-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:17px}.menu-form-field{display:flex;flex-direction:column;gap:7px}
.menu-form-field label{font-size:13px;font-weight:650;color:#284866}.menu-form-field input,.menu-form-field select{width:100%;min-height:42px;padding:10px 12px;border:1px solid #cdd9e7;border-radius:8px;background:#fff;color:#18324f;font:inherit;font-size:14px}
.menu-form-field input:focus,.menu-form-field select:focus{outline:0;border-color:#69b5ff;box-shadow:0 0 0 3px #39a6f829}.menu-form-error{font-size:12px;color:#c14444}
.menu-form-actions{display:flex;gap:10px;margin-top:22px}.menu-form-submit,.menu-form-cancel{display:inline-flex;align-items:center;justify-content:center;min-height:40px;padding:9px 15px;border-radius:9px;font-size:13px;font-weight:650;text-decoration:none}
.menu-form-submit{background:#247ce5;border:1px solid #247ce5;color:#fff;cursor:pointer}.menu-form-submit:hover{background:#1769d2;color:#fff}.menu-form-cancel{border:1px solid #cdd9e7;color:#526b84;background:#fff}
@media(max-width:600px){.menu-form-grid{grid-template-columns:1fr}.menu-form-card{padding:17px}}
</style>
@endpush

@section('content')
<section class="menu-form-page"><div class="menu-form-card">
    <h1 class="menu-form-title">Thêm menu mới</h1>
    <p class="menu-form-subtitle">Nhập thông tin menu sẽ được hiển thị trong hệ thống.</p>
    <form method="POST" action="{{ route('menu.store') }}">
        @csrf
        <div class="menu-form-grid">
            <div class="menu-form-field"><label for="ten">Tên menu *</label><input id="ten" name="ten" value="{{ old('ten') }}" required maxlength="255" placeholder="Ví dụ: Trang chủ">@error('ten')<span class="menu-form-error">{{ $message }}</span>@enderror</div>
            <div class="menu-form-field"><label for="url">Đường dẫn *</label><input id="url" name="url" value="{{ old('url') }}" required maxlength="255" placeholder="Ví dụ: / hoặc /sinhvien">@error('url')<span class="menu-form-error">{{ $message }}</span>@enderror</div>
            <div class="menu-form-field"><label for="vi_tri">Vị trí *</label><select id="vi_tri" name="vi_tri" required><option value="">-- Chọn vị trí --</option>@foreach($viTriOptions as $key => $label)<option value="{{ $key }}" {{ old('vi_tri') === $key ? 'selected' : '' }}>{{ $label }}</option>@endforeach</select>@error('vi_tri')<span class="menu-form-error">{{ $message }}</span>@enderror</div>
            <div class="menu-form-field"><label for="nhom">Nhóm</label><input id="nhom" name="nhom" value="{{ old('nhom') }}" maxlength="255" placeholder="Ví dụ: Học vụ">@error('nhom')<span class="menu-form-error">{{ $message }}</span>@enderror</div>
            <div class="menu-form-field"><label for="thu_tu">Thứ tự hiển thị *</label><input id="thu_tu" type="number" name="thu_tu" value="{{ old('thu_tu', 0) }}" min="0" max="99999" required>@error('thu_tu')<span class="menu-form-error">{{ $message }}</span>@enderror</div>
            <div class="menu-form-field"><label for="trang_thai">Trạng thái *</label><select id="trang_thai" name="trang_thai" required><option value="1" {{ old('trang_thai', '1') == '1' ? 'selected' : '' }}>Hiển thị</option><option value="0" {{ old('trang_thai') === '0' ? 'selected' : '' }}>Ẩn</option></select>@error('trang_thai')<span class="menu-form-error">{{ $message }}</span>@enderror</div>
        </div>
        <div class="menu-form-actions"><button type="submit" class="menu-form-submit">Lưu menu</button><a href="{{ route('menu.index') }}" class="menu-form-cancel">Hủy</a></div>
    </form>
</div></section>
@endsection
