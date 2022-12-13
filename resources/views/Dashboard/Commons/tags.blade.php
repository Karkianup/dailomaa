<script src="{{asset('Asset/Dashboard/ajax/jquery/jquery-2.2.2.min.js')}}"></script>
<script src="{{asset('Asset/Dashboard/js/chosen.jquery.min.js')}}"></script>
<link href="{{asset('Asset/Dashboard/css/chosen.css')}}" rel="stylesheet" />
<div class="card">
    <div class="card-body">
        <div class="box-header with-border">
            <h3 class="box-title">Tags</h3>
        </div>
        <div class="box-footer" style="display: block;">
            <select data-placeholder="Choose tags ..." class="browser-default multiple-select custom-select" multiple
                name="tag_id[]" tabindex="4">
                @foreach($tags as $tag)
                <option value="{{old('id',$tag->id)}}">{{$tag->english_title}}</option>
                @endforeach
            </select>

        </div>
    </div>
</div>


<script>
    $(".multiple-select").chosen();
$('button').click(function(){
        $(".multiple-select").val('').trigger("chosen:updated");
});
</script>