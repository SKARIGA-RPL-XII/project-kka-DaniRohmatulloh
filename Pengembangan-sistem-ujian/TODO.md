# Fix Pengaturan Soal Ujian (examp.blade.php)

**Requirements**:
1. Card "Soal Tersedia" **kosong awal** (no soal).
2. Filter mapel → **show soal** (auto populate from $soals).
3. Pilih soal → **add to "Soal Terpilih"** (persist, no reset).
4. **Fix nama**: "Sejarah" bukan "Soal 1" → use mataPelajaran.nama_mapel.

**Plan**:
1. [ ] JS `initializeData()` → `currentDisplayQuestions = [];` (kosong).
2. [ ] `filterBySubject()` → populate soal, persist selected.
3. [ ] Name display → `mapelName` from mataPelajaran.find().
4. [ ] Test.

Proceed step-by-step.
