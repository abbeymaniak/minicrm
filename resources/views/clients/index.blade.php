<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container w-full md:w-4/5 xl:w-full  mx-auto px-2 bg-white py-5">

		<!--Card-->
        <a href="{{ route('clients.create') }}" class="underline my-3 pl-4">Add new Client</a>
		<div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow ">


			<table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
				<thead>
					<tr>
						<th>Company</th>
						<th>Vat</th>
						<th>Address</th>
						<th>edit / delete </th>
					</tr>
				</thead>
				<tbody>
                    @foreach($clients as $client)
                    <tr>
                        <td>{{ $client->company_name }}</td>
                        <td>{{ $client->company_vat }}</td>
                        <td>{{ $client->company_address }}</td>
                        <td>
                            <a href="{{ route('clients.edit', $client) }}" class="btn btn
                                btn-primary">Edit</a> |
                                <form action="{{ route('clients.destroy', $client) }}" method="POST"
                                    style="display: inline-block;" onsubmit="return confirm('are you sure?')" class="text-red-500">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    </td>
                                    </tr>
                                    @endforeach

				</tbody>

			</table>


            <div class="mt-4">
                {{ $clients->links() }}
            </div>
		</div>
		<!--/Card-->


	</div>
	<!--/container-->

        </div>
    </div>
</x-app-layout>
