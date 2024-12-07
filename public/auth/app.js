let inactivityTime = function () {
    let timeout;

    const resetTimer = () => {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            Swal.fire({
                title: 'Pemberitahuan: Tidak Ada Interaksi Terbaru <p> Tampilan Ini ',
                        html: 'Kami mendeteksi tidak ada interaksi dalam beberapa waktu. Apakah Anda ingin melanjutkan aktivitas ini?',
                        icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    resetTimer();
                } else {
                    logout();
                }
            });
        }, 300000);
    };
    window.onload = resetTimer;
    window.onmousemove = resetTimer;
    window.onkeypress = resetTimer;
    window.ontouchstart = resetTimer;
};

inactivityTime();

function logout() {
    fetch('/logout', {
        method: 'POST',
        headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`
        }
    }).then(response => {
        if (response.ok) {
            window.location.href = '/login';
        } else {
            alert('Logout gagal, silakan coba lagi.');
        }
    }).catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat logout.');
    });
    
}

async function login() {
    const nip = document.getElementById('nip').value;
    const name = document.getElementById('name').value;

    const response = await fetch('http://localhost:3000/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ nip, name })
    });

    if (response.ok) {
        const data = await response.json();
        localStorage.setItem('token', data.data.token);
        alert('Login berhasil');
        window.location.href = 'http://localhost:8080/dashboard';
    } else {
        const errorData = await response.json();
        alert(errorData.message);
    }
}

async function logout() {
    const token = localStorage.getItem('token');

    if (!token) {
        alert('Anda belum login.');
        return;
    }

    const response = await fetch('http://localhost:3000/logout', {
        method: 'POST',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json'
        }
    });

    if (response.ok) {
        localStorage.removeItem('token');
        alert('Logout berhasil');
        window.location.href = 'login.php';
    } else {
        const errorData = await response.json();
        alert(errorData.message);
    }
}

