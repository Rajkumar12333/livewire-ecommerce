<div>
<section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach($products as $data)
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{asset('storage/'.$data->image)}}">
                            <h5><a href="{{route('shop-detail',$data->unique_id)}}">{{$data->title}}</a></h5>
                        </div>
                    </div>
                    @endforeach
                  
                </div>
            </div>
        </div>
    </section>
</div>
