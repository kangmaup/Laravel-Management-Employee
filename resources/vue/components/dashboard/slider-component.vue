<template>
    <div>
        <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider>

<div class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-4@m">
    <div>
        <img src="../../assets/images/image-1.jpg" width="400" height="600" alt="">
        <div class="uk-position-center uk-panel"><h1></h1></div>
    </div>
    <div>
        <img src="../../assets/images/image-2.jpg" width="400" height="600" alt="">
        <div class="uk-position-center uk-panel"><h1></h1></div>
    </div>
    <div>
        <img src="../../assets/images/image-3.jpg" width="400" height="600" alt="">
        <div class="uk-position-center uk-panel"><h1></h1></div>
    </div>
    <div>
        <img src="../../assets/images/image-4.jpg" width="400" height="600" alt="">
        <div class="uk-position-center uk-panel"><h1></h1></div>
    </div>
    <div>
        <img src="../../assets/images/image-5.jpg" width="400" height="600" alt="">
        <div class="uk-position-center uk-panel"><h1></h1></div>
    </div>
    <div>
        <img src="../../assets/images/image-1.jpg" width="400" height="600" alt="">
        <div class="uk-position-center uk-panel"><h1></h1></div>
    </div>
    <div>
        <img src="../../assets/images/image-2.jpg" width="400" height="600" alt="">
        <div class="uk-position-center uk-panel"><h1></h1></div>
    </div>
    <div>
        <img src="../../assets/images/image-3.jpg" width="400" height="600" alt="">
        <div class="uk-position-center uk-panel"><h1></h1></div>
    </div>
    <div>
        <img src="../../assets/images/image-4.jpg" width="400" height="600" alt="">
        <div class="uk-position-center uk-panel"><h1></h1></div>
    </div>
    <div>
        <img src="../../assets/images/image-5.jpg" width="400" height="600" alt="">
        <div class="uk-position-center uk-panel"><h1></h1></div>
    </div>
</div>

<a class="uk-position-center-left uk-position-small uk-hidden-hover" href uk-slidenav-previous uk-slider-item="previous"></a>
<a class="uk-position-center-right uk-position-small uk-hidden-hover" href uk-slidenav-next uk-slider-item="next"></a>

</div>
    </div>
  </template>

  <script>
  export default {
    name: 'Slider',
    data() {
      return {
        slides: [
          { image: "", caption: 'Caption 1' },
          { image: "", caption: 'Caption 2' },
          { image: "", caption: 'Caption 3' },
          { image: "", caption: 'Caption 4' },
          { image: "", caption: 'Caption 5' }
        ]
      };
    }
  };
  </script>

  <style scoped>
  /* Gaya tambahan untuk slider */
  /* Lebar tinggi slider */
  .uk-slideshow-items img {
    width: 100%;
    height: 100%;
  }

  /* Gaya overlay */
  .uk-overlay-primary {
    background-color: rgba(0, 0, 0, 0.5); /* Ubah warna overlay sesuai kebutuhan */
  }

  /* Gaya caption */
  .uk-overlay h3 {
    color: white; /* Ubah warna teks sesuai kebutuhan */
  }
  </style>
