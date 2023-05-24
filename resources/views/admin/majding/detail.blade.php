<div class="modal-body">
    <div class="col-md-6 col-lg-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
        <div class="icon-box">
            <div class="img mb-3">
                <a href="#"><img src="{{ url('/storage/' .$detail->image)}}" style="width: 80px;"></a>
            </div>
            <h4 class="title">{{ $detail->judul }}</h4>
                <b>
                </b>
                <p class="description"></p>
                <p class="description>"{{ $detail->buat }}"></p>
        </div>
    </div>
</div>
