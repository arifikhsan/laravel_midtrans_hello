<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Midtrans</title>
</head>

<body>
    <h3>Selected Items:</h3>
    <ul>
        <li>Jeruk 2 kg x @20000</li>
        <li>Apel 3 kg x @18000</li>
    </ul>

    <h4>Total: Rp 94.000,00</h4>

    <form action="/pay" method="post">
        @csrf
        <input type="hidden" name="amount" value="94000" />
        <input type="submit" value="Confirm">
    </form>
</body>

</html>
