<div class="container">
    <form action="{{ route('dating.search') }}" method="GET">
        @csrf
        <label class="block mt-4 mb-2 text-sm font-semibold">Search</label>
        <textarea name="query" class="w-full p-2 border rounded" rows="4" placeholder="Write something ....">{{request()->get('query')}}</textarea>
         <!-- Gender -->
         <label class="block mt-4 mb-2 text-sm font-semibold">Gender</label>
         <select name="gender" class="w-full p-2 border rounded" >
             <option value="" selected>Select Gender</option>
             <option value="female">Female</option>
             <option value="male">Male</option>
             <option value="other">Other</option>
         </select>
        <!-- Search Button -->
        <button type="submit" class="w-full bg-pink-500 text-white py-2 mt-6 rounded hover:bg-pink-600">Search</button>
    </form>
</div>