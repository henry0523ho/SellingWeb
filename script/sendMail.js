// 記得先載入<script src="https://smtpjs.com/v3/smtp.js"></script>

function sendMail(to, subject, body) {
    Email.send({
        SecureToken: "d24dc5d9-4bad-488c-b636-bc372c91e63a",
        To: to,
        From: "chen3ho5yang12@gmail.com",
        Subject: subject,
        Body: body
    }).then(
        message => alert(message)
    );
}