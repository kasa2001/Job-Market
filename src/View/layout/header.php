<header class="navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar bg-dark" style="height: 70px;">
    <a class="navbar-brand mr-0 mr-md-2" href="/" aria-label="BlackFramework">Giełda pracy</a>
    <div class="bs-tooltip-right" style="margin-left: auto">
        <?php if (!$this->isLogged()): ?>
            <a class="text-white" href="/registry">Zarejestruj</a>
            <a class="btn btn-success d-none d-lg-inline-block mb-3 mb-md-0 ml-md-3" href="/login">Zaloguj się</a>
        <?php else:
            $user = $user = $this->getLoggedUser();
            ?>
            <a class="text-white mr-2" href="/listOffer">Lista ofert</a>
            <a class="text-white mr-2" href="/addOffer">Dodaj ofertę</a>
            <a class="text-white mr-2" href="/profile/<?= $user->id ?>">Profil</a>
            <?php if ($this->hasRole('ROLE_ADMIN')): ?>
                <a class="text-white mr-2" href="/userLists">Zarządzaj użytkownikami</a>
                <a class="text-white mr-2" href="/skillList">Lista umiejętności</a>
                <a class="text-white mr-2" href="/addSkill">Dodaj umiejętność</a>
            <?php endif ?>
            <a class="btn btn-danger text-white" href="/logout">Wyloguj</a>
        <?php endif ?>
    </div>
</header>