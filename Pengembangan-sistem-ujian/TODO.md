# Update: DUPLIKAT CONTROLLER DITEMUKAN!

**Root Cause Fixed**: Route `guru.mapel.store` panggil **app/Http/Controllers/Guru/MapelController.php** (JSON), bukan yang kita edit.

## Next Steps
- [x] Step 1: Fixed wrong MapelController.php
- [x] Step 2: Edit **app/Http/Controllers/Guru/MapelController.php** (replace JSON → redirect success)
- [ ] Step 3: Test & complete
