 @if ($errors->any())
 <div class="error mt-2" >
     <ul>
         @foreach ($errors->all() as $error)
         <li class="text-danger">{{ $error }}</li>
         @endforeach
     </ul>
 </div>
 @endif
