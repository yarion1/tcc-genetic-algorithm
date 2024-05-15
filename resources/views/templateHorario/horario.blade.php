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
        page-break-after: always;
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
@php
    function mesmoDia($events, $horaInicial, $horaFinal)
    {
        $day = date('Y-m-d');
        $start = strtotime($day . ' ' . $events['startTime']);
        $start8 = strtotime($day . ' ' . $horaInicial);
        $end = strtotime($day . ' ' . $events['endTime']);
        $end8 = strtotime($day . ' ' . $horaFinal);

        return $start >= $start8 && $end <= $end8;
    }
@endphp

<body>
    @foreach ($dados as $index => $horario)
        <table class="tg{{ $loop->last ? '' : ' page-break' }}">
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
                <tr>

                    <td class="tg-0pky" rowspan="3" style="background-color: #FCE198; width: 30px;">
                        08:00:00 - 11:40:00
                    </td>
                    @for ($day = 1; $day <= 5; $day++)
                        <td class="tg-0pky" style="margin: 0; padding: 0;">
                            <table style="border:none; border-collapse: collapse; border-spacing: 0; width: 100%">
                                <tr>
                                    @php
                                        $eventsOfDay = array_filter($horario['events'], function ($event) use ($day) {
                                            return $event['daysOfWeek'] == $day &&
                                                mesmoDia($event, '08:00:00', '11:40:00');
                                        });
                                    @endphp
                                    @foreach ($eventsOfDay as $key => $event)
                                        <td
                                            style="border: none; max-width: 60px; vertical-align: middle;  text-align: center;">
                                            {{ $event['title'] }}</td>
                                             <td
                                                style="border-right: 1px solid #CCCCCC; width: 1px; border-top: none; border-bottom: none; border-left: none">
                                            </td>
                                       
                                    @endforeach
                                </tr>
                            </table>
                        </td>
                    @endfor
                </tr>




                <tr>

                    @for ($day = 1; $day <= 5; $day++)
                        <td class="tg-0pky" style="margin: 0; padding: 0;">
                            <table style="border:none; border-collapse: collapse; border-spacing: 0; width: 100%">
                                <tr>
                                    @php
                                        $eventsOfDay = array_filter($horario['events'], function ($event) use ($day) {
                                            return $event['daysOfWeek'] == $day &&
                                                mesmoDia($event, '08:00:00', '11:40:00');
                                        });
                                    @endphp
                                    @foreach ($eventsOfDay as $key => $event)
                                        <td
                                            style="border: none; max-width: 60px; vertical-align: middle;  text-align: center;">
                                            {{ $event['room']['name'] }}</td>
                                        @if ($key < count($eventsOfDay) - 1)
                                            <td
                                                style="border-right: 1px solid #CCCCCC; width: 1px; border-top: none; border-bottom: none; border-left: none">
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            </table>
                        </td>
                    @endfor
                </tr>

                <tr>

                    @for ($day = 1; $day <= 5; $day++)
                        <td class="tg-0pky" style="margin: 0; padding: 0; background-color: #cfe2f2;">
                            <table style="border:none; border-collapse: collapse; border-spacing: 0; width: 100%">
                                <tr>
                                    @php
                                        $eventsOfDay = array_filter($horario['events'], function ($event) use ($day) {
                                            return $event['daysOfWeek'] == $day &&
                                                mesmoDia($event, '08:00:00', '11:40:00');
                                        });
                                    @endphp
                                    @foreach ($eventsOfDay as $key => $event)
                                        <td
                                            style="border: none; max-width: 60px; vertical-align: middle;  text-align: center;">
                                            {{ $event['professor']['pessoa']['apelido'] }}</td>
                                        @if ($key < count($eventsOfDay) - 1)
                                            <td
                                                style="border-right: 1px solid #CCCCCC; width: 1px; border-top: none; border-bottom: none; border-left: none">
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            </table>
                        </td>
                    @endfor
                </tr>

                <tr>
                    <td class="tg-0pky" rowspan="3" style="background-color: #FCE198; width: 30px;">
                        14:00:00 - 17:40:00
                    </td>

                    @for ($day = 1; $day <= 5; $day++)
                        <td class="tg-0pky" style="margin: 0; padding: 0;">
                            <table style="border:none; border-collapse: collapse; border-spacing: 0; width: 100%">
                                <tr>
                                    @php
                                        $eventsOfDay = array_filter($horario['events'], function ($event) use ($day) {
                                            return $event['daysOfWeek'] == $day &&
                                                mesmoDia($event, '14:00:00', '17:40:00');
                                        });
                                    @endphp
                                    @foreach ($eventsOfDay as $key => $event)
                                        <td
                                            style="border: none; max-width: 60px; vertical-align: middle;  text-align: center;">
                                            {{ $event['title'] }}</td>
                                        @if ($key < count($eventsOfDay) - 1)
                                            <td
                                                style="border-right: 1px solid #CCCCCC; width: 1px; border-top: none; border-bottom: none; border-left: none">
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            </table>
                        </td>
                    @endfor
                </tr>

                <tr>

                    @for ($day = 1; $day <= 5; $day++)
                        <td class="tg-0pky" style="margin: 0; padding: 0;">
                            <table style="border:none; border-collapse: collapse; border-spacing: 0; width: 100%">
                                <tr>
                                    @php
                                        $eventsOfDay = array_filter($horario['events'], function ($event) use ($day) {
                                            return $event['daysOfWeek'] == $day &&
                                                mesmoDia($event, '14:00:00', '17:40:00');
                                        });
                                    @endphp
                                    @foreach ($eventsOfDay as $key => $event)
                                        <td
                                            style="border: none; max-width: 60px; vertical-align: middle;  text-align: center;">
                                            {{ $event['room']['name'] }}</td>
                                        @if ($key < count($eventsOfDay) - 1)
                                            <td
                                                style="border-right: 1px solid #CCCCCC; width: 1px; border-top: none; border-bottom: none; border-left: none">
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            </table>
                        </td>
                    @endfor
                </tr>

                <tr>

                    @for ($day = 1; $day <= 5; $day++)
                        <td class="tg-0pky" style="margin: 0; padding: 0; background-color: #cfe2f2;">
                            <table style="border:none; border-collapse: collapse; border-spacing: 0; width: 100%">
                                <tr>
                                    @php
                                        $eventsOfDay = array_filter($horario['events'], function ($event) use ($day) {
                                            return $event['daysOfWeek'] == $day &&
                                                mesmoDia($event, '14:00:00', '17:40:00');
                                        });
                                    @endphp
                                    @foreach ($eventsOfDay as $key => $event)
                                        <td
                                            style="border: none; max-width: 60px; vertical-align: middle;  text-align: center;">
                                            {{ $event['professor']['pessoa']['apelido'] }}</td>
                                        @if ($key < count($eventsOfDay) - 1)
                                            <td
                                                style="border-right: 1px solid #CCCCCC; width: 1px; border-top: none; border-bottom: none; border-left: none">
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            </table>
                        </td>
                    @endfor
                </tr>


                <tr>

                    <td class="tg-0pky" rowspan="3" style="background-color: #FCE198; width: 30px;">
                        19:00:00 - 22:40:00
                    </td>
                    @for ($day = 1; $day <= 5; $day++)
                        <td class="tg-0pky" style="margin: 0; padding: 0;">
                            <table style="border:none; border-collapse: collapse; border-spacing: 0; width: 100%">
                                <tr>
                                    @php
                                        $eventsOfDay = array_filter($horario['events'], function ($event) use ($day) {
                                            return $event['daysOfWeek'] == $day &&
                                                mesmoDia($event, '19:00:00', '22:40:00');
                                        });
                                    @endphp
                                    @foreach ($eventsOfDay as $key => $event)
                                        <td
                                            style="border: none; max-width: 60px; vertical-align: middle;  text-align: center;">
                                            {{ $event['title'] }}</td>
                                        @if ($key < count($eventsOfDay) - 1)
                                            <td
                                                style="border-right: 1px solid #CCCCCC; width: 1px; border-top: none; border-bottom: none; border-left: none">
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            </table>
                        </td>
                    @endfor
                </tr>

                <tr>

                    @for ($day = 1; $day <= 5; $day++)
                        <td class="tg-0pky" style="margin: 0; padding: 0;">
                            <table style="border:none; border-collapse: collapse; border-spacing: 0; width: 100%">
                                <tr>
                                    @php
                                        $eventsOfDay = array_filter($horario['events'], function ($event) use ($day) {
                                            return $event['daysOfWeek'] == $day &&
                                                mesmoDia($event, '19:00:00', '22:40:00');
                                        });
                                    @endphp
                                    @foreach ($eventsOfDay as $key => $event)
                                        <td
                                            style="border: none; max-width: 60px; vertical-align: middle;  text-align: center;">
                                            {{ $event['room']['name'] }}</td>
                                        @if ($key < count($eventsOfDay) - 1)
                                            <td
                                                style="border-right: 1px solid #CCCCCC; width: 1px; border-top: none; border-bottom: none; border-left: none">
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            </table>
                        </td>
                    @endfor
                </tr>

                <tr>

                    @for ($day = 1; $day <= 5; $day++)
                        <td class="tg-0pky" style="margin: 0; padding: 0; background-color: #cfe2f2;">
                            <table style="border:none; border-collapse: collapse; border-spacing: 0; width: 100%">
                                <tr>
                                    @php
                                        $eventsOfDay = array_filter($horario['events'], function ($event) use ($day) {
                                            return $event['daysOfWeek'] == $day &&
                                                mesmoDia($event, '19:00:00', '22:40:00');
                                        });
                                    @endphp
                                    @foreach ($eventsOfDay as $key => $event)
                                        <td
                                            style="border: none; max-width: 60px; vertical-align: middle;  text-align: center;">
                                            {{ $event['professor']['pessoa']['apelido'] }}</td>
                                        @if ($key < count($eventsOfDay) - 1)
                                            <td
                                                style="border-right: 1px solid #CCCCCC; width: 1px; border-top: none; border-bottom: none; border-left: none">
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            </table>
                        </td>
                    @endfor
                </tr>



            </tbody>
        </table>

    @endforeach

</body>

</html>
