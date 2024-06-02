<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div> --}}
            <section class="vh-100" style="background-color: #eee;">
                <div class="container py-5 h-100">
                  <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-lg-9 col-xl-7">
                      <div class="card rounded-3">
                        <div class="card-body p-4">

                          <h4 class="text-center my-3 pb-3">To Do App</h4>

                          <form class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2" action="{{ route('todoliststore') }}" method="POST">
                            @csrf
                            <div class="col-12">
                                <div class="form-outline">
                                    <input type="text" id="title" name="title" class="form-control" />
                                    <label class="form-label" for="title">Enter a task here</label>
                                </div>
                            </div>

                            <!-- Hidden field for default status -->
                            {{-- <input type="hidden" id="status" name="status" value="0"> --}}

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                            <div class="col-12">
                                <a href="{{ route('todolistadd')}}" type="button" class="btn btn-secondary">ADD</a>
                            </div>


                          <table class="table mb-4">
                            <thead>
                              <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Todo item</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                                @forelse ($todopass as $todopassnew)
                              <tr>
                                <th scope="row">{{ $todopassnew->id }}</th>
                                <td>{{ $todopassnew->title }}</td>
                                <td>{{ $todopassnew->status }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        @if($todopassnew->status == 1)
                                        <a href="{{ route('todolistedit', ['id'=>$todopassnew->id]) }}" type="button" class="btn btn-secondary">Not Finished</a>
                                        @else
                                        <a href="{{ route('todolistedit', ['id'=>$todopassnew->id]) }}" type="button" class="btn btn-primary">Finished</a>
                                        @endif

                                        <a href="{{ route('todolistdelete', ['id'=>$todopassnew->id]) }}" type="button" class="btn btn-danger">Delete</a>
                                    </div>
                                </td>
                              </tr>
                              @empty
                              <tr>
                                  <td class="text-center" colspan="5"> not any found</td>
                              </tr>
                              @endforelse
                            </tbody>
                          </table>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
        </div>
    </div>
</x-app-layout>
