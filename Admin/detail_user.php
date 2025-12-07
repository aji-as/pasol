<?php
require_once "../config.php";
$id = $_GET['id'];
$user =get_user_by_id($id);

// Helper Warna Role
$roleColor = 'text-gray-600 bg-gray-50 border-gray-200';
if($user['role'] == 'admin') $roleColor = 'text-purple-700 bg-purple-50 border-purple-200';
if($user['role'] == 'penjual') $roleColor = 'text-[#00A651] bg-[#00A651]/10 border-green-200';
if($user['role'] == 'pembeli') $roleColor = 'text-blue-700 bg-blue-50 border-blue-200';
?>

<div class="max-w-5xl mx-auto p-4 md:p-8 bg-gray-50 min-h-screen font-sans">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-4">
            <a href="daftar_users.php" class="p-2.5 bg-white rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-100 transition shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Detail Pengguna</h2>
                <p class="text-sm text-gray-500">Informasi lengkap akun</p>
            </div>
        </div>

        <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="flex items-center justify-center gap-2 bg-[#00A651] text-white px-6 py-2.5 rounded-xl font-semibold text-sm hover:bg-green-700 transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            Edit Data
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden p-6 md:p-8">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">

            <div class="space-y-2">
                <label class="flex items-center text-sm font-bold text-gray-600 uppercase tracking-wide">
                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Nama Lengkap
                </label>
                <input type="text" value="<?php echo $user['nama_lengkap']; ?>" 
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 font-medium focus:outline-none cursor-default" readonly>
            </div>

            <div class="space-y-2">
                <label class="flex items-center text-sm font-bold text-gray-600 uppercase tracking-wide">
                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Email Address
                </label>
                <input type="text" value="<?php echo $user['email']; ?>" 
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 font-medium focus:outline-none cursor-default" readonly>
            </div>

            <div class="space-y-2">
                <label class="flex items-center text-sm font-bold text-gray-600 uppercase tracking-wide">
                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    No. Handphone
                </label>
                <div class="relative">
                    <input type="text" value="<?php echo $user['no_hp']; ?>" 
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 font-medium focus:outline-none cursor-default" readonly>
                    <a href="https://wa.me/62<?php echo ltrim($user['no_hp'], '0'); ?>" target="_blank" class="absolute inset-y-0 right-3 flex items-center text-[#00A651] hover:text-green-700 transition" title="Chat WhatsApp">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    </a>
                </div>
            </div>

            <div class="space-y-2">
                <label class="flex items-center text-sm font-bold text-gray-600 uppercase tracking-wide">
                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    Role / Hak Akses
                </label>
                <div class="w-full px-4 py-3 rounded-xl border border-gray-200 font-bold capitalize flex items-center gap-2 <?php echo $roleColor; ?>">
                    <span class="w-2 h-2 rounded-full bg-current"></span>
                    <?php echo $user['role']; ?>
                </div>
            </div>

            <div class="space-y-2">
                <label class="flex items-center text-sm font-bold text-gray-600 uppercase tracking-wide">
                    ID User
                </label>
                <div class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-500 font-mono font-medium">
                    #<?php echo $user['id']; ?>
                </div>
            </div>

            <div class="space-y-2">
                <label class="flex items-center text-sm font-bold text-gray-600 uppercase tracking-wide">
                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Tanggal Bergabung
                </label>
                <input type="text" value="<?php echo date('d F Y, H:i', strtotime($user['created_at'])); ?>" 
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 font-medium focus:outline-none cursor-default" readonly>
            </div>

            <div class="space-y-2">
                <label class="flex items-center text-sm font-bold text-gray-600 uppercase tracking-wide">
                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    Password
                </label>
                <input type="password" value="SandiRahasia" 
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-500 font-medium focus:outline-none cursor-default" readonly>
            </div>

            <div class="space-y-2 md:col-span-2">
                <label class="flex items-center text-sm font-bold text-gray-600 uppercase tracking-wide">
                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Alamat Lengkap
                </label>
                <textarea rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 font-medium focus:outline-none cursor-default resize-none" readonly><?php echo $user['alamat_blok']; ?></textarea>
            </div>

        </div>
    </div>
</div>