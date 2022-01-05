<!-- <div class="mb-3">
    <label class="form-label fs-3">Obat memiliki Nomor Izin Edar? </label>
    <div class="input-group">
        <div class="form-check form-check-inline">
            <input class="btn-check" type="radio" name="terdaftarNIE" id="terdaftarNIE" autocomplete="off" checked>
            <label for="terdaftarNIE" class="btn btn-outline-primary fs-3">Terdaftar</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="btn-check" type="radio" name="TidakTerdaftarNIE" id="TidakTerdaftarNIE" autocomplete="off">
            <label for="TidakTerdaftarNIE" class="btn btn-outline-secondary fs-3">Tidak Terdaftar</label>
        </div>
    </div>
</div> -->
<div class="mb-3">
    <label class="form-label fs-3">Merk Obat :</label>
    <div class="input-group has-validation">
        <div class="form-check form-check-inline">
            <input class="btn-check" type="radio" name="kode_1" id="namaDagang" autocomplete="off" value="D" checked>
            <label for="namaDagang" class="btn btn-outline-primary fs-3">Nama Dagang</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="btn-check" type="radio" name="kode_1" id="generik" autocomplete="off" value="G">
            <label for="generik" class="btn btn-outline-primary fs-3">Generik</label>
        </div>
    </div>
</div>
<div class="mb-3">
    <label class="form-label fs-3" for="kode_2">Tipe Obat : </label>
    <select id="kode_2" name="kode_2" class="form-select form-select-lg fs-3" aria-label="Default select example" required>
        <option value="" selected>--Pilih salah satu--</option>
        <option value="B">Obat Bebas</option>
        <option value="T">Obat Bebas Terbatas</option>
        <option value="K">Obat Keras</option>
        <option value="P">Psikotropika</option>
        <option value="N">Narkotika</option>
    </select>
    <div class="invalid-feedback">
        Mohon pilih salah satu
    </div>
</div>
<div class="mb-3">
    <label class="form-label fs-3">Asal Obat :</label>
    <div class="input-group has-validation">
        <div class="form-check form-check-inline">
            <input class="btn-check" type="radio" name="kode_3" id="impor" autocomplete="off" value="I" checked>
            <label for="impor" class="btn btn-outline-primary fs-3">Obat Impor</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="btn-check" type="radio" name="kode_3" id="lokal" autocomplete="off" value="L">
            <label for="lokal" class="btn btn-outline-primary fs-3">Obat Lokal</label>
        </div>
    </div>
</div>
<div class="mb-3">
    <label for="kode_4" class="form-label fs-3">Tahun Produksi :</label>
    <input type="number" class="form-control fs-3" name="kode_4" id="tahun" aria-describedby="tahunHelp" placeholder="09" required>
    <div id="tahunHelp" class="form-text">Masukkan 2 angka terakhir pada tahun produksi</div>
    <div class="invalid-feedback">
        Mohon diisi
    </div>
</div>
<div class="mb-3">
    <label for="kode_5" class="form-label fs-3">Nomor Urut Pabrik :</label>
    <input type="number" class="form-control fs-3" name="kode_5" id="noPabrik" aria-describedby="noPabrikHelp" placeholder="123" required>
    <div id="noPabrikHelp" class="form-text">Masukkan 3 angka nomor urut pabrik</div>
    <div class="invalid-feedback">
        Mohon diisi
    </div>
</div>
<div class="mb-3">
    <label for="kode_6" class="form-label fs-3">Nomor Urut Obat :</label>
    <input type="number" class="form-control fs-3" name="kode_6" id="noUrutObat" aria-describedby="noUrutObatHelp" placeholder="123" required>
    <div id="noUrutObatHelp" class="form-text">Masukkan 3 angka nomor urut obat</div>
    <div class="invalid-feedback">
        Mohon diisi
    </div>
</div>
<div class="mb3">
    <label class="form-label fs-3" for="kode_7">Bentuk Sediaan Obat : </label>
    <select name="kode_7" class="form-select form-select-lg fs-3" aria-label="Default select example" required>
        <option value="" selected>--Pilih salah satu--</option>
        <option value="01">01 - Kapsul</option>
        <option value="23">23 - Powder/Serbuk Oral</option>
        <option value="43">43 - Injeksi</option>
        <option value="02">02 - Kapsul Lunak</option>
        <option value="24">24 - Bedak/Talk</option>
        <option value="44">44 - Injeksi Suspensi Kering</option>
        <option value="04">04 - Kaplet</option>
        <option value="28">28 - Gel</option>
        <option value="09">09 - Kaplet Salut Film</option>
        <option value="29">29 - Krim, Krim Steril</option>
        <option value="46">46 - Tetes Mata</option>
        <option value="10">10 - Tablet</option>
        <option value="30">30 - Salep</option>
        <option value="47">47 - Tetes Hidung</option>
        <option value="11">11 - Tablet Effervescent</option>
        <option value="31">31 - Salep Mata</option>
        <option value="48">48 - Tetes Telinga</option>
        <option value="12">12 - Tablet Hisap</option>
        <option value="32">32 - Emulsi</option>
        <option value="49">49 - Infus</option>
        <option value="14">14 - Tablet Lepas Terkontrol</option>
        <option value="33">33 - Suspensi</option>
        <option value="53">53 - Supositoria, Ovula</option>
        <option value="34">34 - Elixir</option>
        <option value="56">56 - Nasal Spray</option>
        <option value="15">15 - Tablet Salut Enterik</option>
        <option value="36">36 - Drops</option>
        <option value="58">58 - Rectal Tube</option>
        <option value="16">16 - Pil</option>
        <option value="37">37 - Sirup/Larutan</option>
        <option value="62">62 - Inhalasi</option>
        <option value="17">17 - Tablet Salut Selaput</option>
        <option value="38">38 - Suspensi Kering</option>
        <option value="63">63 - Tablet Kunyah</option>
        <option value="22">22 - Granul</option>
        <option value="41">41 - Lotion/Solutio</option>
        <option value="81">81 - Tablet Dispersi</option>
    </select>
    <div class="invalid-feedback">
        Mohon pilih salah satu
    </div>
</div>
<div class="mb3">
    <label class="form-label fs-3" for="kode_8">Kekuatan Sediaan Obat : </label>
    <select name="kode_8" class="form-select form-select-lg fs-3" aria-label="Default select example" required>
        <option value="" selected>--Pilih salah satu--</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
    </select>
    <div class="invalid-feedback">
        Mohon pilih salah satu
    </div>
</div>
<div class="mb3">
    <label class="form-label fs-3" for="kode_9">Kekuatan Sediaan Obat : </label>
    <select name="kode_9" class="form-select form-select-lg fs-3" aria-label="Default select example" required>
        <option value="" selected>--Pilih salah satu--</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select>
    <div class="invalid-feedback">
        Mohon pilih salah satu
    </div>
</div>