<?php view("partials/head.php") ?>
<body>
<?php view("partials/header.php") ?>

<main>
    <section class="page-hero">
        <div class="container">
            <h1><?= $isAdmin ? 'All Members' : 'My Club Members' ?></h1>
            <p><?= $isAdmin ? 'Viewing all registered members across every club.' : 'Viewing members in your club.' ?></p>
        </div>
    </section>

    <section class="section">
        <div class="container">

            <?php if (empty($members)): ?>
                <p style="text-align:center; color: var(--text-muted);">No members found.</p>
            <?php else: ?>
                <table style="width:100%; border-collapse:collapse; background:white; border-radius:12px; overflow:hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.08);">
                    <thead style="background: var(--navy); color: white;">
                        <tr>
                            <th style="padding:14px 18px; text-align:left;">#</th>
                            <th style="padding:14px 18px; text-align:left;">Full Name</th>
                            <th style="padding:14px 18px; text-align:left;">Email</th>
                            <th style="padding:14px 18px; text-align:left;">Club</th>
                            <th style="padding:14px 18px; text-align:left;">Role</th>
                            <th style="padding:14px 18px; text-align:left;">Joined</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($members as $i => $member): ?>
                            <tr style="border-bottom:1px solid #eee; <?= $i % 2 === 0 ? 'background:#f9f9f9;' : 'background:white;' ?>">
                                <td style="padding:12px 18px;"><?= $i + 1 ?></td>
                                <td style="padding:12px 18px;"><?= htmlspecialchars($member['full_name']) ?></td>
                                <td style="padding:12px 18px;"><?= htmlspecialchars($member['email']) ?></td>
                                <td style="padding:12px 18px;"><?= htmlspecialchars($member['club'] ?? 'N/A') ?></td>
                                <td style="padding:12px 18px;">
                                    <span style="
                                        padding:3px 10px;
                                        border-radius:20px;
                                        font-size:0.8rem;
                                        font-weight:600;
                                        background: <?= $member['role'] === 'admin' ? 'var(--gold)' : '#e8f0fe' ?>;
                                        color: <?= $member['role'] === 'admin' ? 'var(--navy)' : '#1a56db' ?>;
                                    ">
                                        <?= htmlspecialchars($member['role']) ?>
                                    </span>
                                </td>
                                <td style="padding:12px 18px; color:#666;">

                                    <?= (new DateTime($member['created_at']))->format('M d, Y') ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

            <p style="margin-top:2rem;">
                <a href="/" class="btn btn-primary">Go to Home</a>
            </p>

        </div>
    </section>
</main>

<?php view("partials/footer.php") ?>
<script src="script.js"></script>
</body>
</html>

