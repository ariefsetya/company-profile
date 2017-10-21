@extends('layouts.app')

@section('content')
<div class="carousel carousel-slider" data-indicators="true">
    <a class="carousel-item" href="#one!"><img src="{{url('image/1.png')}}"></a>
    <a class="carousel-item" href="#two!"><img src="{{url('image/2.png')}}"></a>
    <a class="carousel-item" href="#three!"><img src="{{url('image/3.png')}}"></a>
    <a class="carousel-item" href="#four!"><img src="{{url('image/4.png')}}"></a>
</div>

<div class="quote_home" style="text-align: right;" id="aboutus">
    <div style="margin-left: 30%;">
    <h1>Kokon Production</h1>
    <p>Event Organizer merupakan bentuk service yang dapat menciptakan image, profesionalisme, dan kesuksesan suatu perusahaan, product, bahkan klient itu sendiri melalui berbagai macam bentuk dan program acara.</p>
    <p>
    KOKON PRODUCTION berdiri dibawah PT. Duta Art Propertindo, hadir dengan tenaga profesional, kompeten, dan berpengalaman yang menjaga konsistensi kualitas dari service kami. Memberikan efisiensi dan efektifitas kepada klient dalam membuat suatu acara akan menjadi suatu pengalaman yang tidak akan terlupakan, terasa di hati penyelenggara dan peserta acara.
</p>
<p>
    Saya percaya KOKON PRODUCTION dapat mewujudkan suatu acara yang mewakili jiwa, visi dan impian Anda menjadi suatu kenyataan yang digambarkan melalui bentuk-bentuk acara yang di selenggarakan, serta memeriahkan dan memperkaya kegiatan.</p>

<p>
    "Kesuksesan Acara Mencerminkan Kesuksesan Anda"</p>

    <h4>~ Muljadi Suhardi (Kokon)</h4>
    </div>
</div>
@foreach(\App\Contents::wherePageId($data->id)->get() as $key)
<div class="quote2" id="{{$key->slug}}" style="background: url({{url('image/'.$data->id.'.png')}});background-size: cover;background-position: bottom;">
</div>
<div class="quote" id="{{$key->slug}}_2">
    @foreach(\App\Subcontents::whereContentId($key->id)->get() as $child)
    <h2 style="color:#333;">{{$child->title}}</h2>
    <p style="color:#333;">{{$child->description}}</p>
    @endforeach
</div>

@endforeach

@endsection

@section('footer')
<script type="text/javascript">
    $('.carousel.carousel-slider').carousel({fullWidth: true});
    $(".carousel").height($(window).height());
    @foreach(\App\Contents::wherePageId(1)->get() as $key)
    $("#{{$key->slug}}").height($(window).height()/4);
    $("#{{$key->slug}}_2").height($(window).height()/4);
    @endforeach

    function goto(id){
        var id = $("#"+id);
        var target = $(id);
        target = target.length ? target : $('[name=' + id.slice(1) + ']');
            if (target.length) {
            event.preventDefault();
            $('html, body').animate({
              scrollTop: target.offset().top
            }, 1000, function() {
              var $target = $(target);
              $target.focus();
              if ($target.is(":focus")) {
                return false;
              } else {
                $target.attr('tabindex','-1');
                $target.focus();
              };
            });
        }
    }
    $( window ).resize(function() {
        $(".carousel").height($(window).height());
        @foreach(\App\Contents::wherePageId(1)->get() as $key)
        $("#{{$key->slug}}").height($(window).height()/4);
        $("#{{$key->slug}}_2").height($(window).height()/4);
        @endforeach
    });
</script>
<style type="text/css">
*{
    outline: none;
}
.logo{
    position: absolute;
    top: 10px;
    right: 20px;
    z-index: 9999999;
}
.carousel.carousel-slider{
    z-index: 99999;
}
.quote {
  background: #dd4b39;
  position: relative;
  z-index: 1;
}
.quote_home {
  background: #dd4b39;
  position: relative;
  z-index: 1;
}
.quote:before, .quote:after {
  background: inherit;
  content: '';
  display: block;
  height: 100%;
  left: 0;
  position: absolute;
  right: 0;
  z-index: -10;
  -webkit-backface-visibility: hidden;
}
.quote:before {
  top: -80px;
  -webkit-transform: skewY(3deg);
          transform: skewY(3deg);
  -webkit-transform-origin: 30% 0;
          transform-origin: 30% 0;
}
.quote:after {
  bottom: -80px;
  -webkit-transform: skewY(-3deg);
          transform: skewY(-3deg);
  -webkit-transform-origin: 30%;
          transform-origin: 30%;
}
.quote2:before, .quote2:after {
  background: inherit;
  content: '';
  display: block;
  height: 50%;
  left: 0;
  position: absolute;
  right: 0;
  z-index: -10;
  -webkit-backface-visibility: hidden;
}
.quote2:before {
  top: -100px;
  -webkit-transform: skewY(2deg);
          transform: skewY(2deg);
  -webkit-transform-origin: 30% 0;
          transform-origin: 30% 0;
}
.quote2:after {
  bottom: -100px;
  -webkit-transform: skewY(-2deg);
          transform: skewY(-2deg);
  -webkit-transform-origin: 30%;
          transform-origin: 30%;
}

.quote {
  color: #fff;
  font-family: 'Fira Sans', sans-serif;
  margin: 0px 0;
  padding: 10px 20px;
  /*text-align: center;*/
}
.quote2 {
  color: #333;;
  font-family: 'Fira Sans', sans-serif;
  padding: 18% 20px;
  /*text-align: center;*/
}
.quote_home {
  color: #333;;
  font-family: 'Segoe UI', sans-serif;
  padding: 1% 50px;
  padding-top: 20px;
  /*text-align: center;*/
}
.quote_home:before, .quote_home:after {
  background: inherit;
  content: '';
  display: block;
  height: 50%;
  left: 0;
  position: absolute;
  right: 0;
  z-index: -10;
  -webkit-backface-visibility: hidden;
}
.quote_home:before {
  top: -100px;
  -webkit-transform: skewY(3deg);
          transform: skewY(3deg);
  -webkit-transform-origin: 30% 0;
          transform-origin: 30% 0;
}
.quote_home:after {
  bottom: -100px;
  -webkit-transform: skewY(-3deg);
          transform: skewY(-3deg);
  -webkit-transform-origin: 30%;
          transform-origin: 30%;
}
</style>
@endsection
