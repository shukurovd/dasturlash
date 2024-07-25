<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My applications') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                    <h1 class="mb-3 text-xl text-blue-500 font-bold">My Applications</h1>
                        @foreach($applications as $application)
                            <div class=''>  
                                <div class="rounded-xl border p-5 shadow-md  bg-white mt-3">
                                    <div class="flex w-full items-center justify-between border-b pb-3">
                                        <div class="flex items-center space-x-3">
                                            <div class="h-8 w-8 rounded-full bg-slate-400 bg-[url('https://i.pravatar.cc/32')]"></div>
                                            <div class="text-lg font-bold text-slate-700">{{$application->user->name}}</div>
                                        </div>
                                        <div class="flex items-center space-x-8">
                                            <button class="rounded-2xl border bg-neutral-100 px-3 py-1 text-xs font-semibold"># {{$application->id}}</button>
                                            <div class="text-xs text-neutral-500">{{$application->created_at}}</div>
                                        </div>
                                    </div>
                                    <div class="flex justify-between">
                                        <div>    
                                            <div class="mt-4 mb-3">
                                                <div class="mb-3 text-xl font-bold">{{$application->subject}}</div>
                                                <div class="text-sm text-neutral-600">{{$application->message}}</div>
                                            </div>
                                            <div>
                                                <div class="flex items-center justify-between text-slate-500">
                                                    <div class="flex space-x-4 md:space-x-8">
                                                        <div class="flex cursor-pointer items-center transition hover:text-slate-600">
                                                        {{$application->user->email}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if($application->file_url)
                                            <div class="border mt-6 mb-6 p-6 rounded hover:bg-gray-50 transition cursor-pointer flex flex-col items-center">
                                                <a href="{{ asset('storage/'.$application->file_url) }}" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 9h3.75m-4.5 2.625h4.5M12 18.75 9.75 16.5h.375a2.625 2.625 0 0 0 0-5.25H9.75m.75-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    @if($application->answer()->exists())
                                        <div class="text-slate-500">
                                            <hr class="border">
                                            <div class="text-blue-500"><h3>Answer:</h3></div>
                                            <p>{{ $application->answer->body }}</p>
                                        </div>
                                    @else
                                        @if(auth()->user()->role->name=='manager')
                                            <div class="flex justify-end">
                                                <a href="{{route('answers.create', ['application' => $application->id])}}" type="button" class="py-1 px-3 my-2 bg-emerald-500 text-white font-medium rounded hover:bg-indigo-500 cursor-pointer ease-in-out duration-300">Answer</a>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        
                        {{ $applications->links() }}

                    </div>
                </div>
            </div>
        </div>
    
</x-app-layout>
