// Function mengambil data ipk
function fetchIPK() {
  var nim = document.getElementById("daftarnim").value;
  var semester = document.getElementById("daftarsemester").value;

  if (nim !== "" && semester !== "") {
    var fetch = new XMLHttpRequest();
    fetch.open("POST", "func/fetch_ipk.php", true);
    fetch.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    fetch.onreadystatechange = function () {
      if (fetch.readyState === 4 && fetch.status === 200) {
        var ipk = parseFloat(fetch.responseText);
        document.getElementById("daftaripk").value = ipk;
        document.getElementById("ipk_display").value = ipk;

        if (!isNaN(ipk)) {
          if (ipk >= 3) {
            // jika ipk >= 3 maka field tidak disabled
            document.getElementById("pilihan_beasiswa").disabled = false;
            document.getElementById("berkas_syarat").disabled = false;
            document.getElementById("submit_button").disabled = false;
          } else {
            // jika ipk < 3 maka field akan disabled
            document.getElementById("pilihan_beasiswa").disabled = true;
            document.getElementById("berkas_syarat").disabled = true;
            document.getElementById("submit_button").disabled = true;
            // popup error message
            Swal.fire({
              icon: "error",
              title: "IPK tidak sesuai syarat",
              text:
                "Maaf, IPK anda " +
                ipk +
                " berada di bawah minimal! Minimal untuk mendaftar adalah 3.0",
            }).then(function () {
              window.location = "daftar_beasiswa.php";
            });
          }
        } else {
          // log error
          console.error("Invalid IPK value received:", ipk);
        }
      }
    };
    // mengirim data ke func/fetch_ipk.php
    fetch.send(
      "nim=" +
        encodeURIComponent(nim) +
        "&semester=" +
        encodeURIComponent(semester)
    );
  }
}
