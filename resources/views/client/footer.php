<?= $body['footer']; ?>
<div id="thongbao"></div>
<script src="<?=BASE_URL('public/theme/');?>assets/frontend/js/footer.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
<script>
new ClipboardJS('.copy');
</script>
    <footer> 

     <div class="py-3" style="background: #1b1a1a"> 
      <div class="mt-2 mb-32 md:mb-0 px-4 md:px-0 relative max-w-6xl w-full mx-auto text-white grid grid-cols-12 gap-4 font-semibold text-gray-300"> 
       <div class="col-span-12 md:col-span-5 py-2"> 
         HỆ THỐNG BÁN MÃ NGUỒN TỰ ĐỘNG<br> ĐẢM BẢO UY TÍN VÀ CHẤT LƯỢNG.</span></span> 
       </div> 
       <div class="col-span-12 md:col-span-5 py-2">
         CHÚNG TÔI LUÔN LẤY UY TÍN LÀM HÀNG ĐẦU ĐỐI VỚI KHÁCH HÀNG.
        <br> HI VỌNG SẼ ĐƯỢC PHỤC VỤ CÁC BẠN. CẢM ƠN! 
       </div> 
      </div> 
     </div> 
     <div class="py-2 text-white font-medium" style="background: #151212" bis_skin_checked="1"> 
      <div class="max-w-6xl mx-auto text-center" bis_skin_checked="1">
        Copyright 2021 - 2023. DICHVURIGHT.IO.VN - Thực hiện bởi 
    <a href="<?= $TN->site('link_zalo') ?>"><?= $TN->site('author') ?></a> 
   </div> 
     </div> 
    </footer> 
<button type="button"
    class="cd-top h-10 w-10 border-2 border-blue-600 fixed opacity-90 rounded text-2xl text-white bg-blue-600 rounded-full font-bold flex items-center justify-center focus:outline-none"
    style="right:2%;bottom:14%;"><i class="bx bx-up-arrow-alt"></i></button>
</html>