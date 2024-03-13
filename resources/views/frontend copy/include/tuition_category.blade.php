<style>
    .button-list-nav {
        display:block;
        padding-left: 0;
        padding-top: 10px;
    }
    .button-list-nav li {
        padding: 2px 2px;
        display:inline-block;
    }

    @media all and (max-width: 570px){
        .button-list-nav{
            display: block;
        }
    }

</style>
<ul class="button-list-nav">
    <li>
        <a href="{{ route('tuition_list') }}" class="btn btn-sm {{ request()->get('tuition_category') == false ? 'btn-success' : 'btn-secondary' }}" style="border-radius: 30px; text-decoration: none;">All Tuition</a>
    </li>
    @foreach(\App\Models\TuitionCategory::get() as $tuition_category)
        <li class="pr-2">
            <a href="{{ route('tuition_list') }}?tuition_category={{ $tuition_category->name }}" class="btn btn-sm {{ request()->get('tuition_category') == $tuition_category->name ? 'btn-success' : 'btn-secondary' }}" style="border-radius: 30px; text-decoration: none;">{{ $tuition_category->name }}</a>
        </li>
    @endforeach
</ul>
