
    <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
    <div class="bg-gray-100 rounded-md m-2 w-auto">
        <div class="p-2">
            <h2 {{$title->attributes->merge(['class'=>'text-xl font-semibold'])}}>{{$title }}</h2>
            <div {{$body->attributes->class(['text-gray-600'])}}>
                {{$body}}
            </div>
        </div>

    </div>
</div>
<hr>
