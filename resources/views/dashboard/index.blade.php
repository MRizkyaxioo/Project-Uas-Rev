<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Beranda Mahasiswa - POLIBAN</title>
        <link
            href="https://fonts.googleapis.com/css2?family=Roboto&display=swap"
            rel="stylesheet"
        />
        <style>
            * {
                box-sizing: border-box;
                font-family: "Roboto", sans-serif;
            }

            body {
                margin: 0;
                background-color: #f4f4f4;
            }

            header {
                background-color: #0056bf;
                color: white;
                padding: 1rem 2rem;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            header h1 {
                font-size: 1.5rem;
            }

            nav {
                display: flex;
                gap: 2rem;
                margin-top: 0.5rem;
            }

            nav a {
                color: white;
                text-decoration: none;
                font-weight: bold;
                padding: 0.5rem;
            }

            nav a.active {
                border-bottom: 3px solid #fff;
                padding-bottom: 0.2rem;
            }

            .container {
                padding: 2rem;
                display: flex;
                flex-wrap: wrap;
                gap: 2rem;
            }

            .profile-box,
            .card,


            .profile-box {
                display: inline-block;
                min-width: 250px;
                max-width: 100%;
            }

            .main-content {
                display: flex;
                gap: 2rem;
                width: 100%;
                flex-wrap: wrap;
                align-items: flex-start;
            }

            .main-content .card {
                flex: 1;
                min-width: 350px;
                margin-right: 1rem;
                margin-bottom: 3rem;
                width: auto;
            }

            .card {
                width: calc(100% - 300px - 2rem);
                margin-bottom: 1rem;
            }

            .card-column {
                flex: 1;
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
            }

            .card + .card {
                margin-top: 1rem;
            }

            .card h3 {
                margin: 0;
            }

            .badge {
                background-color: #0066ff;
                color: white;
                padding: 0.2rem 0.6rem;
                border-radius: 12px;
                font-size: 0.75rem;
            }

            .badge.gray {
                background-color: gray;
            }

            .info {
                display: flex;
                justify-content: space-between;
                margin: 1rem 0;
                font-size: 0.9rem;
            }

            .buttons {
                display: flex;
                gap: 1rem;
            }

            .buttons button {
                flex: 1;
                padding: 0.6rem;
                font-size: 1rem;
                border: none;
                border-radius: 6px;
                color: white;
                cursor: pointer;
            }

            .buttons .hadir {
                background: #0056bf;
            }

            .buttons .hadir:hover {
             background: #494949;
            }

            .buttons .sakit {
                background: #0056bf;
            }

            .buttons .sakit:hover {
             background: #494949;
            }

            .buttons .ijin {
                background: #0056bf;
            }

            .buttons .ijin:hover {
             background: #494949;
            }

            .buttons.disabled button {
                background-color: gray;
                cursor: not-allowed;
            }

            .calendar {
                background: white;
                border-radius: 8px;
                box-shadow: 0 20px 20px rgba(0, 0, 0, 0.4);
                padding: 1rem;
                width: 380px; /* Pastikan lebar kalender tetap */
                text-align: center;
                margin: 0 auto; /* Menyelaraskan kalender di tengah */
            }

            .calendar-navigation {
                display: flex;
                justify-content: space-between;
                margin-bottom: 10px;
            }

            .calendar-navigation button {
                background: none;
                border: none;
                font-size: 1.2em;
                cursor: pointer;
            }

            .calendar-table {
                width: 100%;
                border-spacing: 8px;
            }

            .calendar-table th {
                font-weight: bold;
                color: #0056bf;
            }

            .calendar-table td {
                width: 40px;
                height: 40px;
                text-align: center;
                vertical-align: middle;
                border-radius: 50%;
                cursor: pointer;
                margin: 0; /* Pastikan tidak ada margin */
                padding: 0px; /* Pastikan tidak ada padding */
                box-sizing: border-box;
            }

            .calendar-table td.today {
                background: #0056bf;
                color: white;
                font-weight: bold;
            }

            .calendar-table td:hover {
                background: #0041a8;
                color: white;
            }

        </style>
    </head>

    <body>
        <header>
            <div style="display: flex; align-items: center; gap: 1rem">
                <img
                    src="assets/images/poliban.png"
                    alt="Logo Poliban"
                    style="height: 50px; border-radius: 8px"
                />
                <div>
                    <h1 style="margin: 0">POLITEKNIK NEGERI BANJARMASIN</h1>
                    <nav>
                        <a
                            href="{{ url('/dashboard') }}"
                            class="{{ request()->is('/') ? 'active' : '' }}"
                            >Beranda</a
                        >
                        {{-- <a
                            href="{{ url('/jadwal') }}"
                            class="{{ request()->is('jadwal') ? 'active' : '' }}"
                            >Jadwal</a
                        >
                        <a
                            href="{{ url('/bimbingan') }}"
                            class="{{ request()->is('bimbingan') ? 'active' : '' }}"
                            >Bimbingan</a
                        >
                        <a
                            href="{{ url('/hasil-studi') }}"
                            class="{{ request()->is('hasil-studi') ? 'active' : '' }}"
                            >Hasil Studi</a
                        > --}}
                    </nav>
                </div>
            </div>

            <div style="display: flex; align-items: center; gap: 2rem">
                <img
                    src="assets/icon/notifikasi.png"
                    alt="Notifikasi"
                    style="width: 25px; cursor: pointer"
                />
                <img
                    src="assets/icon/settings.png"
                    alt="Settings"
                    style="width: 30px; cursor: pointer"
                />
                <img
                    src="assets/images/profile.jpg"
                    alt="Profil"
                    style="
                        width: 50px;
                        height: 50px;
                        border-radius: 50%;
                        object-fit: cover;
                        cursor: pointer;
                    "
                />
            </div>
        </header>

        <div class="container">
            <div class="profile-box">
                <p>
                    <strong>Hallo, MUHAMMAD RAZIB ADITYA (C030323141)</strong
                    ><br />Kelas: TI-4E (Axioo)
                </p>
            </div>

            <div class="main-content">
                <div class="card-column">
                    <div class="card">
                        <h3>
                            Pemrograman Perangkat Bergerak (4E)
                            <span class="badge">BERLANGSUNG</span>
                        </h3>
                        <p>👤 ARIFIN NOOR ASYIKIN, ST, MT</p>
                        <div class="info">
                            <span>🕒 08.00 - 10.00</span>
                            <span>🏫 Lab Axioo 2</span>
                            <span>📖 Pertemuan ke -2 (Teori)</span>
                        </div>
                        <div class="buttons">
                            <button class="hadir">Hadir</button>
                            <button class="sakit">Sakit</button>
                            <button class="ijin">Ijin</button>
                        </div>
                    </div>

                    <div class="card">
                        <h3>
                            Pemrograman Web (4E)
                            <span class="badge">BERLANGSUNG</span>
                        </h3>
                        <p>👤 AGUS SETIYO BUDI NUGROHO</p>
                        <div class="info">
                            <span>🕒 08.00 - 10.00</span>
                            <span>🏫 Lab Axioo 2</span>
                            <span>📖 Pertemuan ke -2 (Teori)</span>
                        </div>
                        <div class="buttons">
                            <button class="hadir">Hadir</button>
                            <button class="sakit">Sakit</button>
                            <button class="ijin">Ijin</button>
                        </div>
                    </div>
                </div>
                <div class="calendar-container">
                    <h4 style="text-align: left; margin-bottom: 10px;">Kalender</h4> <!-- Pindahkan teks Kalender -->
                    <div class="calendar">
                        <h4 id="monthYear" style="text-align: center; margin-bottom: 10px;"></h4>
                        <div class="calendar-navigation">
                            <button onclick="changeMonth(-1)">&#8592;</button>
                            <button onclick="changeMonth(1)">&#8594;</button>
                        </div>
                        <table class="calendar-table">
                            <thead>
                                <tr>
                                    <th>SEN</th>
                                    <th>SEL</th>
                                    <th>RAB</th>
                                    <th>KAM</th>
                                    <th>JUM</th>
                                    <th>SAB</th>
                                    <th>MIN</th>
                                </tr>
                            </thead>
                            <tbody id="calendarBody">
                            <!-- Kalender akan diisi oleh JavaScript -->
                        </tbody>
                    </table>
                </div>                       <!-- Kalender akan diisi oleh JavaScript -->
                    </tbody>
                </table>
                </div>
            </div>

            <script>
                let currentMonth = (new Date()).getMonth();
                let currentYear = (new Date()).getFullYear();

                function generateCalendar(month = currentMonth, year = currentYear) {
                    const monthNames = [
                        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                    ];
                    const today = new Date();
                    document.getElementById('monthYear').textContent = `${monthNames[month]} ${year}`;

                    const firstDay = new Date(year, month, 1);
                    let startDay = firstDay.getDay() === 0 ? 6 : firstDay.getDay() - 1;
                    const daysInMonth = new Date(year, month + 1, 0).getDate();
                    let calendarBody = '';
                    let date = 1;

                    for (let i = 0; i < 6; i++) {
                        let row = '<tr>';
                        for (let j = 0; j < 7; j++) {
                            if (i === 0 && j < startDay) {
                                row += '<td></td>';
                            } else if (date > daysInMonth) {
                                row += '<td></td>';
                            } else {
                                if (date === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                                    row += `<td class="today">${date}</td>`;
                                } else {
                                    row += `<td>${date}</td>`;
                                }
                                date++;
                            }
                        }
                        row += '</tr>';
                        calendarBody += row;
                        if (date > daysInMonth) break;
                    }
                    document.getElementById('calendarBody').innerHTML = calendarBody;
                }

                function changeMonth(offset) {
                    currentMonth += offset;
                    if (currentMonth < 0) {
                        currentMonth = 11;
                        currentYear--;
                    } else if (currentMonth > 11) {
                        currentMonth = 0;
                        currentYear++;
                    }
                    generateCalendar(currentMonth, currentYear);
                }

                // Initialize
                generateCalendar();
            </script>
        </div>
    </body>
</html>
