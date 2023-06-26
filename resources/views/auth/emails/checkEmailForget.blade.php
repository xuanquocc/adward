<div>
    <div>
        <h2>おはようございます。 {{ $customer->name }}</h2>
        <p>このメールは、忘れたパスワードを回復するのに役立ちます</p>
        <p>パスワードをリセットするには、下のリンクをクリックしてください</p>
        <p>
            <a href="{{ route('getPass', [$customer->id, $customer->token]) }}"
                style="display:inline-block;background:green;color:#fff;padding:7px 25px; font-weight:bold">パスワードを再設定する</a>
        </p>
    </div>
</div>
