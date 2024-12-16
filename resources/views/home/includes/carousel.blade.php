<div class="owl-carousel relative owl-theme owl-carousel1">

    @foreach ($backgrounds as $background)

    <div class="item" style="height: 70vh;">

        <img src="{{ asset('uploads/'. $background->value) }}" id="img_logo_footer" alt="">
    </div>
    @endforeach



</div>
