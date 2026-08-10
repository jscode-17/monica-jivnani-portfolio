require("dotenv").config();
const express = require("express");
const nodemailer = require("nodemailer");

const app = express();

app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(express.static(__dirname)); // serves HTML files

const smtpUser = (process.env.EMAIL_USER || "").trim();
const smtpPass = (process.env.EMAIL_PASSWORD || "").replace(/\s+/g, "");

const transporter = nodemailer.createTransport({
    host: process.env.EMAIL_HOST,
    port: parseInt(process.env.EMAIL_PORT),
    secure: false,
    auth: {
        user: smtpUser,
        pass: smtpPass,
    },
});

app.post("/contact", async(req, res) => {
    const { name, email, message } = req.body;

    try {
        await transporter.sendMail({
            from: `"Monica Website" <${process.env.EMAIL_FROM}>`,
            to: process.env.EMAIL_TO,
            replyTo: email,
            subject: "New Contact Form Message",
            html: `
        <h3>New Contact Message</h3>
        <p><b>Name:</b> ${name}</p>
        <p><b>Email:</b> ${email}</p>
        <p><b>Message:</b></p>
        <p>${message}</p>
      `,
        });

        res.send("Email sent successfully!");
    } catch (err) {
        console.error(err);
        res.status(500).send("Failed to send email");
    }
});

app.listen(process.env.PORT, () => {
    console.log(`Server is running on http://localhost:${process.env.PORT}`);
});
