<!DOCTYPE html>
<html lang="en">
<style type="text/css">
    body {
        font-family: Calibri, "Arial", sans-serif;
        font-size: 10px;
    }

    .tg {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
    }

    .page-break {
        page-break-before: always;
    }

    .tg td {
        border: 1px solid #CCCCCC;
        overflow: hidden;
        padding: 8px 5px;
        word-break: normal;
    }

    .tg th {
        border: 1px solid #CCCCCC;
        font-weight: normal;
        overflow: hidden;
        padding: 10px 5px;
        word-break: normal;
    }

    .tg .tg-0pky {
        border: 1px solid #CCCCCC;
        text-align: center;
        vertical-align: middle;
    }

    .tdAula {
        height: 35px;
        width: 120px;
        font-weight: bold;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horário</title>
</head>

<body>
    @foreach ($dados['horario'] as $index => $horario)
        <table class="tg{{ $index != 0 ? ' page-break' : '' }}">
            <thead>
                <tr>
                    <th class="tg-0pky" colspan="6" style="background-color: #0D5579; color: white; font-weight: bold;">
                        Universidade Federal do Tocantins - Curso de Ciência da Computação -
                        2023/2</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td class="tg-0pky" colspan="6"
                        style="background-color: #01897D; color: white; font-weight: bold;">
                        {{ $horario['periodo'] }}º Período
                    </td>
                </tr>
                <tr style="background-color: #FCE198;">
                    <td class="tg-0pky">Horário</td>
                    <td class="tg-0pky">Segunda</td>
                    <td class="tg-0pky">Terça</td>
                    <td class="tg-0pky">Quarta</td>
                    <td class="tg-0pky">Quinta</td>
                    <td class="tg-0pky">Sexta</td>
                </tr>
                @php
                    $eventsByTimeAndDay = []; // Array para armazenar os eventos por tempo e dia
                @endphp

                @foreach ($horario['events'] as $evento)
                    @php
                        // Criar uma chave única para representar o tempo e o dia do evento
                        $key = $evento['startTime'] . '-' . $evento['endTime'] . '-' . $evento['daysOfWeek'];
                        // Adicionar o evento ao array agrupado por tempo e dia
                        $eventsByTimeAndDay[$key][] = $evento;
                    @endphp
                @endforeach

                @foreach ($eventsByTimeAndDay as $events)
                    @for ($i = 0; $i < count($events); $i++)
                        <tr>
                            @if ($i === 0)
                                <td class="tg-0pky" rowspan="{{ count($events) * 3 }}"
                                    style="background-color: #FCE198;">
                                    08:00 - 11:40
                                </td>
                            @endif
                            @for ($day = 1; $day <= 5; $day++)
                                <td class="tg-0pky tdAula">
                                    @if ($events[$i]['daysOfWeek'] == $day && $events[$i]['startTime'] >= '08:00:00' && $events[$i]['endTime'] <= '11:40:00')
                                        <div>{{ $events[$i]['title'] }}</div>
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            @for ($day = 1; $day <= 5; $day++)
                                <td class="tg-0pky">
                                    @if ($events[$i]['daysOfWeek'] == $day && $events[$i]['startTime'] >= '08:00:00' && $events[$i]['endTime'] <= '11:40:00')
                                        <div> {{ $events[$i]['room']['name'] }}</div>
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            @for ($day = 1; $day <= 5; $day++)
                                <td class="tg-0pky" style="background-color: #cfe2f2;">
                                    @if ($events[$i]['daysOfWeek'] == $day && $events[$i]['startTime'] >= '08:00:00' && $events[$i]['endTime'] <= '11:40:00')
                                        <div> {{ $events[$i]['professor']['pessoa']['apelido'] }}</div>
                                    @endif
                                </td>
                            @endfor
                        </tr>
                    @endfor
                @endforeach

                <tr>
                    <td class="tg-0pky" rowspan="3" style="background-color: #FCE198; width: 30px;">14:00-17:40</td>
                    <td class="tg-0pky"></td>
                    <td class="tg-0pky"></td>
                    <td class="tg-0pky"></td>
                    <td class="tg-0pky"></td>
                    <td class="tg-0pky"></td>
                </tr>
                <tr>
                    <td class="tg-0pky"></td>
                    <td class="tg-0pky"></td>
                    <td class="tg-0pky"></td>
                    <td class="tg-0pky"></td>
                    <td class="tg-0pky"></td>
                </tr>
                <tr>
                    <td class="tg-0pky"></td>
                    <td class="tg-0pky"></td>
                    <td class="tg-0pky"></td>
                    <td class="tg-0pky"></td>
                    <td class="tg-0pky"></td>
                </tr>
                <tr>
                    <td class="tg-0pky" rowspan="3" style="background-color: #FCE198;">19:00-22:40</td>
                    <td class="tg-0pky"></td>
                    <td class="tg-0pky"></td>
                    <td class="tg-0pky"></td>
                    <td class="tg-0pky"></td>
                    <td class="tg-0pky"></td>
                </tr>
                <tr>
                    <td class="tg-0pky"></td>
                    <td class="tg-0pky"></td>
                    <td class="tg-0pky"></td>
                    <td class="tg-0pky"></td>
                    <td class="tg-0pky"></td>
                </tr>
                <tr>
                    <td class="tg-0pky"></td>
                    <td class="tg-0pky"></td>
                    <td class="tg-0pky"></td>
                    <td class="tg-0pky"></td>
                    <td class="tg-0pky"></td>
                </tr>
            </tbody>
        </table>
        {{-- <div class="page-break"></div> --}}
    @endforeach

</body>

</html>
