<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confession Vault Ultimate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root{ --bg:#0f2027; --card:rgba(255,255,255,0.1); --text:white; --input: #1e293b; }
        body.light{ --bg:#f5f5f5; --card:rgba(0,0,0,0.05); --text:#111; --input: #fff; }
        body{ margin:0; font-family:'Segoe UI'; background:var(--bg); color:var(--text); transition: 0.3s; padding-bottom: 50px;}
        .container{ max-width:420px; margin:auto; padding:15px; }
        .card{ background:var(--card); padding:15px; border-radius:15px; margin-bottom:10px; }
        input, select, textarea { 
            width:100%; padding:10px; margin-bottom:10px; border-radius:10px; 
            border:none; outline:none; background: var(--input); color: var(--text); box-sizing: border-box;
        }
        button.submit-btn{ width:100%; padding:10px; border:none; border-radius:10px; background:#ff4b2b; color:white; cursor:pointer; font-weight: bold; }
        .error-list { background: #ef4444; color: white; padding: 10px; border-radius: 10px; margin-bottom: 10px; font-size: 13px; list-style: none; }
        .success-alert { background: #22c55e; color: white; padding: 10px; border-radius: 10px; margin-bottom: 10px; text-align: center; }
        .feed-item{ background:rgba(0,0,0,0.2); padding:12px; border-radius:10px; margin-top:10px; border-left: 4px solid #ff4b2b; }
        .actions{ display:flex; gap:15px; margin-top:10px; font-size: 14px;}
        .actions span { cursor: pointer; transition: 0.2s; }
        .actions span:hover { transform: scale(1.2); }
        .ai-reply{ font-size:12px; margin-top:8px; color:#00ffcc; font-style: italic;}
    </style>
</head>
<body>

<div class="container">
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h3>💌 Confession Vault</h3>
        <span onclick="document.body.classList.toggle('light')" style="cursor:pointer; font-size:20px;">🌙</span>
    </div>

    @if(session('success'))
        <div class="success-alert">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <ul class="error-list">
            @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div class="card">
        <form action="{{ url('/confess') }}" method="POST">
            @csrf
            <input type="text" name="codename" placeholder="Vault Nickname" value="{{ old('codename') }}">
            <input type="email" name="email" placeholder="Recovery Email" value="{{ old('email') }}">
            
            <select name="category">
                <option value="">Choose Category</option>
                <option value="Crush" {{ old('category') == 'Crush' ? 'selected' : '' }}>Crush</option>
                <option value="Rant" {{ old('category') == 'Rant' ? 'selected' : '' }}>Rant</option>
            </select>

            <input type="number" name="spice_level" placeholder="Drama Level (1-10)" value="{{ old('spice_level') }}">

            <textarea name="message" id="messageInput" placeholder="Write your secret...">{{ old('message') }}</textarea>
            
            <button type="submit" class="submit-btn">SUBMIT TO VAULT</button>
        </form>
    </div>

    <div id="feed">
        <h4>Latest Confessions</h4>
        </div>
</div>

<script>
    // 1. Initial Data (Matches your previous logic)
    let confessions = JSON.parse(localStorage.getItem('laravel_confessions')) || [
        { id: 'Anon#7721', message: 'I actually enjoy debugging more than writing new code.', likes: 5, react: 2, time: '2 mins ago', reply: '🤖 A true programmer!' }
    ];

    // 2. Render Function (Keeps Heart & React Functioning)
    function renderFeed() {
        const feed = document.getElementById('feed');
        // Keep the header
        feed.innerHTML = '<h4>Latest Confessions</h4>';
        
        confessions.forEach((item, index) => {
            const div = document.createElement('div');
            div.className = 'feed-item';
            div.innerHTML = `
                <strong>${item.id}</strong><br>
                ${item.message}<br>
                <small style="opacity: 0.6">${item.time}</small>
                <div class="actions">
                    <span onclick="updateCount(${index}, 'likes')">❤️ <b id="l-${index}">${item.likes}</b></span>
                    <span onclick="updateCount(${index}, 'react')">😂 <b id="r-${index}">${item.react}</b></span>
                </div>
                <div class="ai-reply">${item.reply}</div>
            `;
            feed.appendChild(div);
        });
    }

    // 3. Heart & React Click Logic
    function updateCount(index, type) {
        confessions[index][type]++;
        localStorage.setItem('laravel_confessions', JSON.stringify(confessions));
        renderFeed();
    }

    // 4. Handle successful Laravel redirect (add new post to JS feed)
    @if(session('success'))
        // This only runs after a successful Laravel Validation
        const newMsg = "{{ old('message') }}"; // Get the message that was just sent
        const aiResponse = "{{ session('success') }}";
        
        confessions.unshift({
            id: 'Anon#' + Math.floor(Math.random()*9999),
            message: newMsg,
            likes: 0,
            react: 0,
            time: 'Just now',
            reply: aiResponse
        });
        localStorage.setItem('laravel_confessions', JSON.stringify(confessions));
    @endif

    // Initialize
    renderFeed();
</script>

</body>
</html>