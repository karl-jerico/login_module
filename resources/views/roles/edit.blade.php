<x-app-layout>

    <div class="flex flex-col items-center my-8">
        <div class="card">
            <div class="flex items-center justify-between p-4 bg-white border-b-2 rounded-xl w-full ">
                <h4>Create</h4>
                <a href="{{ route('roles.index') }}"
                    class=" float-end text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5  focus:outline-none ">Back</a>
            </div>
            <div class="card-body">
                <div class="relative overflow-x-auto w-full shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Role
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white dark:bg-gray-800">
                                <form action="{{ route('roles.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <td class="px-6 py-4">
                                        <input type="text" name="name" value="{{ $user->name }}" placeholder="Enter Name" class="bg-transparent border rounded-xl focus:ring-0 focus:border-transparent focus:outline-none w-full">
                                    </td>
                                    <td class="px-6 py-4">
                                        <input type="email" name="email" value="{{ $user->email }}" placeholder="Enter Email" class="bg-transparent border rounded-xl focus:ring-0 focus:border-transparent focus:outline-none w-full">
                                    </td>
                                    <td class="px-6 py-4">
                                        Test
                                    </td>
                                    <td class="px-6 py-4">
                                        <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Save</button>
                                    </td>
                                </form>
                            </tr>
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
