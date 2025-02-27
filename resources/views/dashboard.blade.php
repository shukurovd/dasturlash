<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                    @if(auth()->user()->role->name=='manager')   
                    <h1 class="mb-3 text-xl text-blue-500 font-bold">Received Applications</h1>
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
                                           
                                            <div class="flex justify-end">
                                                <a href="{{route('answers.create', ['application' => $application->id])}}" type="button" class="py-1 px-3 my-2 bg-emerald-500 text-white font-medium rounded hover:bg-indigo-500 cursor-pointer ease-in-out duration-300">Answer</a>
                                            </div>
                                        
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @elseif(auth()->user()->role->name=='client') 
                        
                        @if(session()->has('error'))
                            
                            <div class="flex bg-emerald-500 rounded-lg p-4 mb-4 text-sm text-blue-700" role="alert">
                                <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                <div>
                                    <span class="font-medium"> {{ session()->get('error') }}</span> 
                                </div>
                            </div>
                        @endif                        
                        <div class='flex items-center'>
                            <div class='w-full max-w-lg px-10 py-8 mx-auto bg-white rounded-lg shadow-xl'>
                                <div class='max-w-md mx-auto space-y-6'>

                                    <form action="{{ route('applications.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <h2 class="text-2xl font-bold ">Submit your application</h2>
                                        <hr class="my-6">
                                        <label class="uppercase text-sm font-bold opacity-70">Subject</label>
                                        <input type="text" name="subject" required class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded border-2 border-slate-200 focus:border-slate-600 focus:outline-none">
                                        <label class="uppercase text-sm font-bold opacity-70">Message</label>
                                        <textarea rows="5" name="message" required class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded border-2 border-slate-200 focus:border-slate-600 focus:outline-none"></textarea>
                                        
                                        <label class="uppercase text-sm font-bold opacity-70">File</label>
                                        <input type="file" name="file" class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded border-2 border-slate-200 focus:border-slate-600 focus:outline-none">
                                        <input type="submit" class="py-3 px-6 my-2 bg-emerald-500 text-white font-medium rounded hover:bg-indigo-500 cursor-pointer ease-in-out duration-300" value="Send">
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    
</x-app-layout>
