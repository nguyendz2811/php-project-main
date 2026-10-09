<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $allowedSorts = ['id', 'ten', 'url', 'vi_tri', 'nhom', 'thu_tu', 'trang_thai'];
        $sortBy = in_array($request->query('sort_by'), $allowedSorts, true)
            ? $request->query('sort_by') : 'id';
        $sortDir = $request->query('sort_dir') === 'desc' ? 'desc' : 'asc';

        $perPage = (int) $request->query('per_page', 10);
        if (!in_array($perPage, [10, 25, 50, 100], true)) {
            $perPage = 10;
        }

        $query = Menu::query();

        if ($request->filled('search')) {
            $keyword = trim((string) $request->query('search'));
            $query->where(function ($q) use ($keyword) {
                $q->where('ten', 'like', "%{$keyword}%")
                    ->orWhere('url', 'like', "%{$keyword}%")
                    ->orWhere('nhom', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('vi_tri')) {
            $position = strtolower((string) $request->query('vi_tri'));
            if (array_key_exists($position, Menu::VI_TRI)) {
                $query->whereRaw('LOWER(vi_tri) = ?', [$position]);
            }
        }

        if ($request->has('trang_thai') && $request->query('trang_thai') !== '') {
            $status = (string) $request->query('trang_thai');
            if (in_array($status, ['0', '1'], true)) {
                $query->where('trang_thai', (int) $status);
            }
        }

        $menus = $query->orderBy($sortBy, $sortDir)
            ->paginate($perPage)
            ->withQueryString();

        $viTriOptions = Menu::VI_TRI;

        return view('menu.index', compact(
            'menus', 'viTriOptions', 'sortBy', 'sortDir', 'perPage'
        ));
    }

    public function create()
    {
        $viTriOptions = Menu::VI_TRI;
        return view('menu.create', compact('viTriOptions'));
    }

    public function store(Request $request)
    {
        Menu::create($this->validateMenu($request));

        return redirect()->route('menu.index')->with('success', 'Thêm menu thành công.');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $viTriOptions = Menu::VI_TRI;

        return view('menu.edit', compact('menu', 'viTriOptions'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->update($this->validateMenu($request));

        return redirect()->route('menu.index')->with('success', 'Cập nhật menu thành công.');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('menu.index')->with('success', 'Xóa menu thành công.');
    }

    private function validateMenu(Request $request): array
    {
        $data = $request->validate([
            'ten' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'max:255'],
            'vi_tri' => ['required', Rule::in(array_keys(Menu::VI_TRI))],
            'nhom' => ['nullable', 'string', 'max:255'],
            'thu_tu' => ['required', 'integer', 'min:0', 'max:99999'],
            'trang_thai' => ['required', Rule::in(['0', '1', 0, 1])],
        ], [
            'ten.required' => 'Vui lòng nhập tên menu.',
            'url.required' => 'Vui lòng nhập đường dẫn.',
            'vi_tri.required' => 'Vui lòng chọn vị trí menu.',
            'vi_tri.in' => 'Vị trí phải là Header hoặc Sidebar.',
            'thu_tu.required' => 'Vui lòng nhập thứ tự hiển thị.',
            'thu_tu.integer' => 'Thứ tự phải là số nguyên.',
            'thu_tu.min' => 'Thứ tự không được nhỏ hơn 0.',
            'trang_thai.required' => 'Vui lòng chọn trạng thái.',
        ]);

        $data['vi_tri'] = strtolower($data['vi_tri']);
        $data['nhom'] = isset($data['nhom']) && trim($data['nhom']) !== ''
            ? trim($data['nhom']) : null;
        $data['thu_tu'] = (int) $data['thu_tu'];
        $data['trang_thai'] = (int) $data['trang_thai'];

        return $data;
    }
}
