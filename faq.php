<!doctype html>
<html>
 <head>

</head>
<body id="default_theme" class="it_faq">
<div class="col-lg-12">
<div class="card">  
<div class="card-body">
<div class="panel-group" id="accordion" style="margin-top: 0;">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <p class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">1. Bagaimana membuat survey?<i class="fa fa-angle-down"></i></a> </p>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse">
                        <div class="panel-body">
                          <p>Pilih menu survey, kemudian pilih tambahakan survey , isi semua kolom lalu simpan, setelah itu akan dikirim ke halaman list survey, kemudain pilih aksi dengan icon mata untuk masuk kehalaman view survey anda dapat melihat atau menambahakan pertanyaan survey, alam halaman view survey anda dapat membuat pertanyaan kuis, anda juga dapat mengatur pertanyaan kuis, anda juga dapat mengatur poin skor yang bertujuan untuk menetukan jumlah minimum benar dari petanyaan kuis untuk melanjutkan kepertanyaan survey, jika jumlah minimum skor 0 maka kuis tidak akan dimunculkan
                          </p>
                          <?php echo embedYouTubeVideo('5LkBiLriU8I?si=blZM_x-0EvH6GzxT'); ?>                        
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <p class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">2. Bagaimana cara mendapatkan poin? <i class="fa fa-angle-down"></i></a> </p>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                          <p>ada 2 cara mendapatkan poin, yaitu :</p>
                          <p>1. menjawab survey milik orang lain</p>
                          <p>2. membagikan report survey dari survey yang anda buat, dengan sejumlah poin yang anda tentukan</p>
                          <?php echo embedYouTubeVideo('zaL4so7YiOg?si=PeFBaW_yieBD7und'); ?>   
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <p class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">3. cara melihat survey report ?<i class="fa fa-angle-down"></i></a> </p>
                      </div>
                      <div id="collapseFour" class="panel-collapse collapse in">
                        <div class="panel-body">
                          <p>survey report dapat dilihat jika survey yang diambil dan yang dimiliki</p>
                          <?php echo embedYouTubeVideo('TzJ3nITDGbg?si=9AXW7IIylAbqOXwC'); ?>   
                        </div>
                      </div>
                    </div>
                    
                      </div>
                    </div>
                  </div>
</div>
</div>
</div>
</body>
</html>

<?php
function embedYouTubeVideo($videoId) {
    if (empty($videoId)) {
        return 'Invalid video ID';
    }

    $embedUrl = 'https://www.youtube.com/embed/' . htmlspecialchars($videoId, ENT_QUOTES, 'UTF-8');
    return '<iframe width="560" height="315" src="' . $embedUrl . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
}
?>