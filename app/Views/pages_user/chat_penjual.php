<?php
    $toko = $toko ?? [];
    $namaToko = $toko['nama_toko'] ?? 'Nama Toko';
    $deskripsiToko = $toko['deskripsi_toko'] ?? 'Deskripsi penjual atau toko disini';
    $fotoToko = !empty($toko['logo_toko']) ? base_url($toko['logo_toko']) : base_url('assets/img/logo.png');
    $bank = $toko['nama_admin'] ?? 'Admin';
?>

<div style="max-width: 1280px; margin: 0 auto; padding: 40px 20px;">
    <div style="background: white; padding: 32px; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <div style="display: flex; gap: 24px; margin-bottom: 32px; align-items: center;">
            <img src="<?= $fotoToko ?>" alt="Foto Penjual"
                style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;">
            <div>
                <h1 style="margin-bottom: 8px;"><?= esc($namaToko) ?></h1>
                <p style="color: #6b7280;"><?= esc($deskripsiToko) ?></p>
            </div>
        </div>

        <div style="border-top: 1px solid #e5e7eb; padding-top: 24px;">
            <h2 style="margin-bottom: 16px;">Chat dengan Penjual</h2>
            <div
                style="background: #f9fafb; padding: 24px; border-radius: 8px; margin-bottom: 16px; min-height: 300px;">
                <p style="color: #6b7280; text-align: center; padding: 40px;">
                    Fitur chat akan segera tersedia. Untuk sementara, Anda dapat menghubungi penjual melalui informasi
                    berikut:
                </p>
                <div style="background: white; padding: 16px; border-radius: 8px;">
                    <p><strong>Kontak:</strong> <?= esc($toko['whatsapp_cs'] ?? $toko['telepon_admin'] ?? '-') ?></p>
                    <p><strong>CS Email:</strong> <?= esc($toko['email_cs'] ?? $toko['email_admin'] ?? '-') ?></p>
                </div>
            </div>

            <form>
                <div style="display: flex; gap: 12px;">
                    <input type="text" placeholder="Ketik pesan..."
                        style="flex: 1; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px;">
                    <button type="submit"
                        style="background: #005bff; color: white; border: none; padding: 12px 24px; border-radius: 8px; font-weight: 600; cursor: pointer;">
                        Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>