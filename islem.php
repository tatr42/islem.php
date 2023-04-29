<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'baglan.php';
if (isset($_POST['genelayarkaydet'])) {

    $ayarkaydet = $db->prepare("UPDATE ayar SET
        ayar_siteurl=?,
        ayar_title=?,
        ayar_description=?,
        ayar_keywords=?,
        ayar_author=?
        WHERE ayar_id=0"
    );

    $uplate = $ayarkaydet->execute(array(
        $_POST['ayar_siteurl'],
        $_POST['ayar_title'],
        $_POST['ayar_description'],
        $_POST['ayar_keywords'],
        $_POST['ayar_author']
    ));

    if ($uplate) {

        Header ("location:../production/genelayar.php?durum=ok");

    } else {

        Header ("location:../production/genelayar.php?durum=no");
}



}


if (isset($_POST['iletisimayarkaydet'])) {

    $ayarkaydet = $db->prepare("UPDATE ayar SET
        ayar_tel=?,
        ayar_gsm=?,
        ayar_faks=?,
        ayar_mail=?,
        ayar_adres=?,
        ayar_ilce=?,
        ayar_il=?,
        ayar_mesai=?
        WHERE ayar_id=0"
    );

    $uplate = $ayarkaydet->execute(array(
        $_POST['ayar_tel'],
        $_POST['ayar_gsm'],
        $_POST['ayar_faks'],
        $_POST['ayar_mail'],
        $_POST['ayar_adres'],
        $_POST['ayar_ilce'],
        $_POST['ayar_il'],
        $_POST['ayar_mesai']
    ));

    if ($uplate) {
        Header ("location:../production/iletisimayar.php?durum=ok");
    } else {
        Header ("location:../production/iletisimayar.php?durum=no");
    }
}


if (isset($_POST['apiayarkaydet'])) {

    $ayarkaydet = $db->prepare("UPDATE ayar SET
        ayar_recaptcha=?,
        ayar_googlemap=?,
        ayar_analytics=?
        WHERE ayar_id=0"
    );

    $uplate = $ayarkaydet->execute(array(
        $_POST['ayar_recaptcha'],
        $_POST['ayar_googlemap'],
        $_POST['ayar_analytics']
    ));

    if ($uplate) {
        Header ("location:../production/apiayar.php?durum=ok");
    } else {
        Header ("location:../production/apiayar.php?durum=no");
    }
}


if (isset($_POST['sosyalayarkaydet'])) {

    $ayarkaydet = $db->prepare("UPDATE ayar SET
        ayar_facebook=?,
        ayar_twitter=?,
        ayar_youtube=?,
        ayar_google=?,
        ayar_instagram=?
        WHERE ayar_id=0"
    );

    $uplate = $ayarkaydet->execute(array(
        $_POST['ayar_facebook'],
        $_POST['ayar_twitter'],
        $_POST['ayar_youtube'],
        $_POST['ayar_google'],
        $_POST['ayar_instagram']
    ));

    if ($uplate) {
        Header ("location:../production/sosyalayar.php?durum=ok");
    } else {
        Header ("location:../production/sosyalayar.php?durum=no");
    }
}

if (isset($_POST['mailayarkaydet'])) {

    $ayarkaydet = $db->prepare("UPDATE ayar SET
        ayar_smtphost=?,
        ayar_smtpuser=?,
        ayar_smtpassword=?,
        ayar_smtport=?
        WHERE ayar_id=0"
    );

    $uplate = $ayarkaydet->execute(array(
        $_POST['ayar_smtphost'],
        $_POST['ayar_smtpuser'],
        $_POST['ayar_smtpassword'],
        $_POST['ayar_smtport']
    ));

    if ($uplate) {
        Header ("location:../production/mailayar.php?durum=ok");
    } else {
        Header ("location:../production/mailayar.php?durum=no");
    }
}

if (isset($_POST['hakkimizdakaydet'])) {

    $hakkimizdakaydet = $db->prepare("UPDATE hakkimizda SET
        hakkimizda_baslik=?,
        hakkimizda_icerik=?,
        hakkimizda_video=?,
        hakkimizda_vizyon=?,
        hakkimizda_misyon=?
        WHERE hakkimizda_id=0"
    );

    $uplate = $hakkimizdakaydet->execute(array(
        $_POST['hakkimizda_baslik'],
        $_POST['hakkimizda_icerik'],
        $_POST['hakkimizda_video'],
        $_POST['hakkimizda_vizyon'],
        $_POST['hakkimizda_misyon']
    ));

    if ($uplate) {
        Header ("location:../production/hakkimizda.php?durum=ok");
    } else {
        Header ("location:../production/hakkimizda.php?durum=no");
    }
}


$slidersil = isset($_GET['slidersil']) ? $_GET['slidersil'] : ''; // Eğer slidersil değeri yoksa boş string olarak tanımlanacak
if ($slidersil == "ok") {
    // Silme işlemleri
    $sil = $db->prepare("DELETE FROM slider WHERE slider_id = :slider_id");
    $kontrol = $sil->execute(array(
        'slider_id' => $_GET['slider_id']
    ));
    if ($kontrol) {
        header("location:../production/slider.php?durum=ok");
    } else {
        header("location:../production/slider.php?durum=no");
    }
} elseif ($slidersil == "no") {
    // Düzenleme işlemleri
}






if (isset($_POST['sliderkaydet'])) {
  $uploads_dir ='../../speed/images/slider';
  $tmp_name = $_FILES['slider_resimyol']['tmp_name'];
  $name = $_FILES['slider_resimyol']['name'];
  $size = $_FILES['slider_resimyol']['size'];
  $file_type = $_FILES['slider_resimyol']['type'];

  $max_width = 1280;
  $max_height = 720;

  // check file type
  if($file_type != 'image/jpeg' && $file_type != 'image/png') {
    header("location:../production/slider.php?durum=no&type=invalid");
    exit;
  }

  // check file size
  if($size > 5000000) {
    header("location:../production/slider.php?durum=no&type=size");
    exit;
  }

  // check image dimensions
  $dimensions = getimagesize($tmp_name);
  if($dimensions[0] != $max_width || $dimensions[1] != $max_height) {
    header("location:../production/slider.php?durum=no&type=dimensions");
    exit;
  }


  $benzersizsayi1=rand(20000,32000);
  $benzersizsayi2=rand(20000,32000);
  $benzersizsayi3=rand(20000,32000);
  $benzersizsayi4=rand(20000,32000);
  $benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
  $refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
  move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

  if ($_FILES['slider_resimyol']["size"] <= 0) {
      // Hata mesajı ver ve işlemi durdur
      header("location:../production/slider.php?durum=no&type=size");
      exit;
  } else {
      // Devam et
      echo "Resim var devam kaptan";
  }

  } else {
    $kaydet = $db->prepare("INSERT INTO slider SET
        slider_ad=?,
        slider_link=?,
        slider_sıra=?,
        slider_durum=?,
        slider_resimyol=?"
    );

    $insert = $kaydet->execute(array(
        $_POST['slider_ad'],
        $_POST['slider_link'],
        $_POST['slider_sıra'],
        $_POST['slider_durum'],
      ));

    if ($insert) {
        header("location:../production/slider.php?durum=ok");
    } else {
        header("location:../production/slider.php?durum=no");
    }
  }

if (isset($_POST['sliderdüzenle'])) {
    $slider_id = $_POST['slider_id'];

    if (isset($_POST['sliderkaydet'])) {
        $uploads_dir ='../../speed/images/slider';
        $tmp_name = $_FILES['slider_resimyol']['tmp_name'];
        $name = $_FILES['slider_resimyol']['name'];
        $size = $_FILES['slider_resimyol']['size'];
        $file_type = $_FILES['slider_resimyol']['type'];

        $max_width = 1280;
        $max_height = 720;

        // check file type
        if($file_type != 'image/jpeg' && $file_type != 'image/png') {
            header("location:../production/slider.php?durum=no&type=invalid");
            exit;
        }

        // check file size
        if($size > 5000000) {
            header("location:../production/slider.php?durum=no&type=size");
            exit;
        }

        // check image dimensions
        $dimensions = getimagesize($tmp_name);
        if($dimensions[0] != $max_width || $dimensions[1] != $max_height) {
            header("location:../production/slider.php?durum=no&type=dimensions");
            exit;
        }

        $benzersizsayi1=rand(20000,32000);
        $benzersizsayi2=rand(20000,32000);
        $benzersizsayi3=rand(20000,32000);
        $benzersizsayi4=rand(20000,32000);
        $benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
        $refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
        move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

        $sliderdüzenle = $db->prepare("UPDATE slider SET
        slider_ad=?,
        slider_link=?,
        slider_sıra=?,
        slider_durum=?,
        slider_resimyol=?
        WHERE slider_id=?");

        $uplate = $sliderdüzenle->execute(array(
            $_POST['slider_ad'],
            $_POST['slider_link'],
            $_POST['slider_sıra'],
            $_POST['slider_durum'],
            $refimgyol,
            $slider_id
        ));

        if ($uplate) {
            header("Location:../production/sliderdüzenle.php?slider_id=$slider_id&durum=ok");
        } else {
            header("Location:../production/sliderdüzenle.php?durum=no");
        }

      }



      else {
          $sliderdüzenle = $db->prepare("UPDATE slider SET
            slider_ad=?,
            slider_link=?,
            slider_sıra=?,
            slider_durum=?
            WHERE slider_id=?");

          $uplate = $sliderdüzenle->execute(array(
            $_POST['slider_ad'],
            $_POST['slider_link'],
            $_POST['slider_sıra'],
            $_POST['slider_durum'],
            $slider_id
          ));

          if ($uplate) {
              header("Location:../production/sliderdüzenle.php?slider_id=$slider_id&durum=ok");
          } else {
              header("Location:../production/sliderdüzenle.php?durum=no");
          }
      }




?>
