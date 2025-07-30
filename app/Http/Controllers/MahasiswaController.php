<?php

// app/Http/Controllers/MahasiswaController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Proposal;
use App\Models\Report;
use App\Models\School;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class MahasiswaController extends Controller
{
    public function showRegisterForm()
    {
        return view('mahasiswa.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:50|unique:users,nim',
            'prodi' => 'required|string|max:100',
            'no_telepon' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->nama,
            'nim' => $request->nim,
            'prodi' => $request->prodi,
            'no_telepon' => $request->no_telepon,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa',
        ]);

        Auth::login($user);

        return redirect()->route('mahasiswa.dashboard');
    }

    public function showLoginForm()
    {
        return view('mahasiswa.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nim' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['nim' => $credentials['nim'], 'password' => $credentials['password'], 'role' => 'mahasiswa'], $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('mahasiswa.dashboard'));
        }

        return back()->withErrors([
            'nim' => 'NIM atau Password yang diberikan tidak cocok.',
        ])->onlyInput('nim');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // Cek Auth di semua method di bawah ini
    private function getAuthenticatedUser()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'mahasiswa') {
            abort(403, 'Akses Ditolak');
        }
        return $user;
    }

    public function profil()
    {
        return view('mahasiswa.profil', ['mahasiswa' => $this->getAuthenticatedUser()]);
    }

    public function editProfil()
    {
        return view('mahasiswa.edit-profil', ['mahasiswa' => $this->getAuthenticatedUser()]);
    }

    public function updateProfil(Request $request)
    {
        $user = $this->getAuthenticatedUser();
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'prodi' => 'required|string|max:100',
            'no_telepon' => 'required|string|max:20',
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->name = $validated['nama'];
        $user->prodi = $validated['prodi'];
        $user->no_telepon = $validated['no_telepon'];
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();
        return redirect()->route('mahasiswa.profil')->with('success', 'Profil berhasil diperbarui.');
    }

    public function listProposal()
    {
        $user = $this->getAuthenticatedUser();
        $proposals = Proposal::with('school')->where('user_id', $user->id)->latest()->get();
        return view('mahasiswa.proposal-list', compact('proposals'));
    }

    public function createProposal()
    {
        $schools = School::orderBy('name')->get();
        return view('mahasiswa.proposal-create', compact('schools'));
    }

    public function storeProposal(Request $request)
    {
        $user = $this->getAuthenticatedUser();
        $validated = $request->validate([
            'school_id' => 'required|exists:schools,id',
            'proposed_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);
        $validated['user_id'] = $user->id;
        $validated['status'] = 'diajukan';
        Proposal::create($validated);
        return redirect()->route('mahasiswa.proposal.list')->with('success', 'Pengajuan berhasil diajukan.');
    }

    public function createSchool()
    {
        return view('mahasiswa.school-create');
    }

    public function storeSchool(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'contact_person' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:25',
        ]);
        School::create($validated);
        return redirect()->route('mahasiswa.school.create')->with('success', 'Data sekolah berhasil disimpan.');
    }

    public function createReport(Proposal $proposal)
{
    // Pastikan hanya pembuat proposal yang bisa mengisi laporan
    if ($proposal->user_id !== auth()->id()) {
        abort(403);
    }
    return view('mahasiswa.report-create', compact('proposal'));
}

public function storeReport(Request $request, Proposal $proposal)
{
    // Validasi input
    $request->validate([
        'event_date' => 'required|date',
        'attendees_count' => 'required|integer|min:0',
        'qualitative_notes' => 'required|string',
        'documentation_path' => 'nullable|string|max:255',
    ]);

    // Pastikan hanya pembuat proposal yang bisa menyimpan laporan
    if ($proposal->user_id !== auth()->id()) {
        abort(403);
    }

    // Buat atau perbarui laporan
    Report::updateOrCreate(
        ['proposal_id' => $proposal->id],
        [
            'event_date' => $request->event_date,
            'attendees_count' => $request->attendees_count,
            'qualitative_notes' => $request->qualitative_notes,
            'documentation_path' => $request->documentation_path,
        ]
    );

    // Update status proposal menjadi 'laporan_disubmit'
    $proposal->status = 'laporan_disubmit';
    $proposal->save();

    return redirect()->route('mahasiswa.proposal.list')->with('success', 'Laporan berhasil disubmit.');
}
}