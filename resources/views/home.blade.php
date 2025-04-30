<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sticky Notes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    @auth <!-- If a User is Authenticated -->
    <!-- Display User's Name -->
        <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
            <h1 style="margin: 0;">⌘ {{ auth()->user()->name }}</h1>
            
            <!-- Logout form -->
            <form action="/logout" method="POST">
                @csrf
                <button style="background: none; border: none; cursor: pointer; font-size: 1.2em;">
                    <i class="fas fa-power-off"></i>
                </button>
            </form>
        </div>

    <!-- Create a post form -->
        <div style="border: 2px solid black; padding: 10px; margin:2.5px; background-color:rgb(163, 157, 98)">
            <h2>Create a Sticky Note</h2>
            
            <form action="/create-post" method="POST">
                @csrf
                <div style="margin-bottom: 10px;">
                    <input style="width: 60%; padding: 5px; background: hsl(73, 80.00%, 90.20%)" type="text" name="title" placeholder="Post Title">
                </div>
                
                <div style="margin-bottom: 10px;">
                    <textarea style="width: 60%; height: 100px; padding: 5px; background: hsl(73, 80.00%, 90.20%)" name="body" placeholder="Body content..."></textarea>
                </div>
                <button type="submit" style="padding: 10px 20px; background-color:hsl(55, 71.90%, 62.40%); border: dashed 1px; cursor: pointer;">Create Post</button>
            </form>
        </div>
        
    <!-- Display all posts -->
        <div style="border: 2px solid black; margin:2.5px; background-color:rgb(163, 157, 98)">
            <h2 style="margin-left: 10px">All Notes</h2>
            @foreach($posts as $post)
            <div style="background-color:hsl(55, 71.90%, 62.40%); padding: 10px; margin: 10px; 
                            border: dashed 0.5px;
                            border-radius: 1px; 
                            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);">
    
            <h3>
                {{$post["title"]}} by {{$post->user->name}}
                <span style="font-size: small; color: gray; font-weight: 300;">

                    @if($post->created_at != $post->updated_at)
                        (edited on {{ $post->updated_at->format('F j, Y \a\t g:i A') }})
                    @else
                        (posted on {{ $post->created_at->format('F j, Y \a\t g:i A') }})
                    @endif
                </span>
            </h3>
        
        
        <p>{{$post["body"]}}</p>    

        <div style="margin-top: 10px;">
            @if(auth()->user()->id == $post->user_id)
                <p style="display: inline; margin-right: 10px;">
                    <a href="/edit-post/{{$post->id}}" style="text-decoration: none; color: blue;">✎</a>
                </p>

                <form action="/delete-post/{{$post->id}}" method="POST" style="display:inline;">
                    @csrf
                    @method("DELETE")
                    <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" style="text-decoration: none; color: red;">✖</a>
                </form>
            @endif
        </div>
    </div>

@endforeach

    @else <!-- If a User is not Authenticated -->
    <!-- Register a User form-->
    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 20px; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%; max-width: 500px; padding: 10px;">
        <div style="border: 2px solid black; padding: 10px; background-color: rgb(238, 224, 100); width: 100%; max-width: 500px;">
            <h2>Register</h2>
            <form action="/register" method="POST">
                @csrf
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <input name="name" type="name" placeholder="name" style="background: hsl(73, 80.00%, 90.20%)">
                    <input name="email" type="text" placeholder="email" style="background: hsl(73, 80.00%, 90.20%)">
                    <input name="password" type="password" placeholder="password" style="background: hsl(73, 80.00%, 90.20%)">
                    <button>Register</button>
                </div>
            </form>
        </div>
        
    <!-- Log in -->
        <div style="border: 2px solid black; padding: 10px; background-color: rgb(238, 224, 100); width: 100%; max-width: 500px;">
            <h2>Log in</h2>
            <form action="/login" method="POST">
                @csrf
                <div style="display: flex; gap: 10px; margin-bottom: 10px;">
                    <input name="loginname" type="name" placeholder="name" style="background: hsl(73, 80.00%, 90.20%)">
                    <input name="loginpassword" type="password" placeholder="password" style="background: hsl(73, 80.00%, 90.20%)">
                    <button>Login</button>
                </div>
            </form>
        </div>
    </div>

    <!--** Mobile-Styling **-->
        <style>
            @media (max-width: 600px) {
                div form div {
                flex-direction: column;
                }

                div form input {
                width: 100%;
                }
            }
        </style>
    @endauth
</body>
</html>
