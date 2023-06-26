<div>
    <div>
        <h2>おはようございます。 {{$customer->name}}</h2>
        <p>システムにアカウントを登録しました</p>
        <p>アカウントを使用するには、次のリンクをクリックしてください</p>
        <p>
            <a href="{{route('actived',[ $customer->id,  $customer->token])}}">アクティブなアカウント</a>
        </p>
    </div>
</div>