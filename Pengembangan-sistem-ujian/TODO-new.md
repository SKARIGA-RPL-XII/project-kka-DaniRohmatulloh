# Fix Lihat Hasil Ujian (lihat-hasil-ujian.blade.php + Controller)

**Issues**:
1. Dropdown `Semua Ujian` → **dynamic from Ujian DB** (`$ujianList` available).
2. Dropdown `Semua Kelas` → **"Pilihan Ganda"/"Essay"**.
3. **Pencarian**: `filterResults()` → implement real filter.

**Plan**:
1. [ ] Blade: Fix dropdowns to `@foreach($ujianList)`, type filter "PG/Essay".
2. [ ] JS: `filterResults()` → client-side filter on `$results` data.
3. [ ] Controller: Pass `$soalTypes` or use tipe from Ujian/Hasil.
4. [ ] Test.

Proceed.
