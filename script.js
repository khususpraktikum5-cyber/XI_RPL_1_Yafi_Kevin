function tampilkanNama(){
    document.getElementById("namaAnggota").innerHTML=
    ` 
    <ol style="list-style-type:decimal; padding-left:5%;">
       <li>Galih (Galih@gmail.com)</li>
       <li>Fazan (Fazan@gmail.com)</li>
       <li>Yafi (Yafi@gmail.com)</li>
       <li>Kevin (Kevinn@gmail.com)</li>
       <li>Kevin (naya imut lucu kiyut@gmail.com)</li>
    </ol>

    <button onclick="location.reload()">Tutup Kembali</button>
    `;
    
}

function validasiForm(){
    var tglMulai=document.getElementByld('tgl_mulai').value;
    var tglSelesai=document.getElementByld('tgl_selesai').value;

    if(new Date(tglSelesai) < new Date(tglMulai)){
        alert('Tanggal Selesai Tidak Boleh Lebih Awal Dari Tanggal Mulai!!');
    }
    return true;
}