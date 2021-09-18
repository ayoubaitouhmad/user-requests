<!-- page indexer -->
<div class="row">
    <div class="col-12 grid-margin stretch-card ">
        <div class="dashboard-indexer d-flex justify-content-between   align-items-center">
            <div class="d-flex align-items-center">
                <span class="material-icons">home</span>
                <p class=" mb-0 hover-cursor">&nbsp;&nbsp;{{$page_src ?? ''}}&nbsp;</p>
                <p class=" mb-0 hover-cursor">{{$page_index ?? ''}}</p>
            </div>
            @php($date = new DateTime())
            <span class="m-1">{{date('D H:i')}}</span>
        </div>
    </div>
</div>
