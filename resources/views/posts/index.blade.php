<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <a href="{{ route('posts.create') }}">Add new post</a>
                <table class="table">
                  <thead>
                      <tr>
                          <th>Name</th>
                          <th>Options</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($posts as $post)
                          <tr>
                              <td>{{ $post->title }}</td>
                              <td>
                                  <a href="{{ route('posts.edit', $post) }}">Edit</a>
                                  <form method="POST" action="{{ route('posts.destroy', $post) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
</x-app-layout>
