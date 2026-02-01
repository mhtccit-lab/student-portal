     <x-app-layout>
     <div class="max-w-xl mx-auto py-6">
          @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
          <form method="POST" action="{{ route('courses.store') }}">
               @csrf

               <select name="trade_id" class="w-full border p-2 mb-3">
                    <option value="">Select Trade</option>
                    @foreach($trades as $trade)
                         <option value="{{ $trade->id }}">{{ $trade->name }}</option>
                    @endforeach
               </select>

               <input type="text" name="name" class="w-full border p-2 mb-3" placeholder="Course Name">
               <input type="number" name="duration" class="w-full border p-2 mb-3" placeholder="Duration">
               <input type="number" name="price" class="w-full border p-2 mb-3" placeholder="Price">

               <select name="status" class="w-full border p-2 mb-3">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
               </select>

               <button class="bg-green-600 text-white px-4 py-2 rounded">
                    Save
               </button>
          </form>
     </div>
</x-app-layout>
