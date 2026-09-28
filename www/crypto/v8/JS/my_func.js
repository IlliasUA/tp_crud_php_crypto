/* Configuration de DataTables */

const configuration = {
    order: [[0, "asc"]],
    pagingType: "simple_numbers",
    searching: true,
    lengthMenu: [
        [3, 5, 10, -1],
        ["3", "5", "10", "Tous"]
    ],
    language: {
        info: "Cryptomonnaies _START_ à _END_ sur _TOTAL_",
        emptyTable: "Aucune cryptomonnaie dans le portfolio",
        lengthMenu: "_MENU_ cryptomonnaies par page",
        search: "Rechercher :",
        zeroRecords: "Aucun résultat trouvé",
        paginate: {
            previous: "Précédent",
            next: "Suivant"
        },
        infoFiltered: "(filtré sur _MAX_ cryptomonnaies)",
        infoEmpty: "Cryptomonnaies 0 à 0 sur 0"
    },
    columnDefs: [
        {
            targets: [5],
            orderable: false
        },
        {
            targets: [2, 3, 4, 5],
            searchable: false
        }
    ]
};

let tableCryptos;
let iIndiceEdited = null;

function echapperHTML(texte) {
    return $("<div>").text(texte || "").html();
}

function formaterPrix(nombre) {
    return Number(nombre).toLocaleString("en-US", {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }) + " $";
}

function constructTable() {
    let sHTML = "";

    sHTML += "<thead><tr>";
    sHTML += "<th>Crypto</th>";
    sHTML += "<th>Réseau</th>";
    sHTML += "<th>Quantité</th>";
    sHTML += "<th>Prix d'achat</th>";
    sHTML += "<th>Valeur</th>";
    sHTML += "<th>Actions</th>";
    sHTML += "</tr></thead><tbody>";

    for (let i = 0; i < aOfCryptos.length; i++) {
        let crypto = aOfCryptos[i];

        // Les données HTML commencent à l'indice 1.
        if (!crypto) continue;

        let valeur = Number(crypto["quantite"]) * Number(crypto["prix"]);

        sHTML += "<tr>";
        sHTML += "<td>";
        sHTML += "<strong>" + echapperHTML(crypto["nom"]) + "</strong>";
        sHTML += "<br><small>" + echapperHTML(crypto["symbole"]) + "</small>";
        sHTML += "</td>";
        sHTML += "<td>" + echapperHTML(crypto["reseau"]) + "</td>";
        sHTML += "<td>" + crypto["quantite"] + "</td>";
        sHTML += "<td>" + formaterPrix(crypto["prix"]) + "</td>";
        sHTML += "<td>" + formaterPrix(valeur) + "</td>";
        sHTML += "<td>";

        sHTML +=
            '<button type="button" class="btn btn-edit btn-table" ' +
            'onclick="editCrypto(' + i + ')">Modifier</button>';

        sHTML +=
            '<button type="button" class="btn btn-delete btn-table" ' +
            'onclick="supprimerCrypto(' + i + ')">Supprimer</button>';

        sHTML += "</td></tr>";
    }

    sHTML += "</tbody>";
    $("#table_cryptos").html(sHTML);
}

function rebuildTableau() {
    if ($.fn.DataTable.isDataTable("#table_cryptos")) {
        tableCryptos.clear();
        tableCryptos.destroy();
    }

    constructTable();
    tableCryptos = $("#table_cryptos").DataTable(configuration);
    calculerPortfolio();
}

function calculerPortfolio() {
    let valeurTotale = 0;

    for (let i = 0; i < aOfCryptos.length; i++) {
        if (!aOfCryptos[i]) continue;

        valeurTotale +=
            Number(aOfCryptos[i]["quantite"]) *
            Number(aOfCryptos[i]["prix"]);
    }

    $("#valeur_portfolio").text(formaterPrix(valeurTotale));
}

function afficherFormulaire() {
    iIndiceEdited = null;

    $("#form_crypto")[0].reset();
    $("#section_formulaire").removeClass("hide");
    $("#titre_formulaire").text("Ajouter une cryptomonnaie");
    $("#btn_ajouter").removeClass("hide");
    $("#btn_modifier").addClass("hide");

    document.getElementById("section_formulaire").scrollIntoView({
        behavior: "smooth",
        block: "start"
    });
}

function annulerModification() {
    iIndiceEdited = null;

    $("#form_crypto")[0].reset();
    $("#section_formulaire").addClass("hide");
    $("#btn_ajouter").removeClass("hide");
    $("#btn_modifier").addClass("hide");
}

function recupererCasesCochees(nom) {
    let valeurs = [];

    $('input[name="' + nom + '"]:checked').each(function () {
        valeurs.push($(this).val());
    });

    return valeurs;
}

function libellesCasesCochees(nom) {
    return $('input[name="' + nom + '"]:checked').map(function () {
        return $(this).closest("label").text().trim();
    }).get();
}

function recupererDonneesFormulaire(ancien = null) {
    let crypto = [];

    crypto["id_cryptomonnaie"] = ancien
        ? ancien["id_cryptomonnaie"]
        : Math.max(
            0,
            ...aOfCryptos
                .filter(Boolean)
                .map(c => Number(c["id_cryptomonnaie"]))
        ) + 1;

    crypto["nom"] = $("#nom_crypto").val().trim();
    crypto["symbole"] = $("#symbole_crypto").val().trim().toUpperCase();

    crypto["id_reseau"] = Number($("#reseau").val());
    crypto["reseau"] = $("#reseau option:selected").text().trim();

    crypto["quantite"] = Number($("#quantite").val());
    crypto["prix"] = Number($("#prix_achat").val());

    crypto["dateAchat"] = $("#date_achat").val();
    crypto["dateAchatSql"] =
        ancien && ancien["dateAchat"] === crypto["dateAchat"]
            ? ancien["dateAchatSql"]
            : crypto["dateAchat"] + " 00:00:00";

    crypto["id_niveau_risque"] = Number(
        $('input[name="niveau_risque"]:checked').val()
    );
    crypto["risque"] = $('input[name="niveau_risque"]:checked')
        .closest("label")
        .text()
        .trim();

    crypto["id_strategies"] = recupererCasesCochees("strategies").map(Number);
    crypto["strategies"] = libellesCasesCochees("strategies");

    crypto["id_notifications"] = recupererCasesCochees("notifications")
        .map(Number);
    crypto["id_notification"] = crypto["id_notifications"];
    crypto["notifications"] = libellesCasesCochees("notifications");

    crypto["notes"] = $("#notes").val().trim();

    return crypto;
}

function ajouterCrypto() {
    let nouvelleCrypto = recupererDonneesFormulaire();

    aOfCryptos.push(nouvelleCrypto);

    rebuildTableau();
    annulerModification();
}

function editCrypto(iIndiceToEdit) {
    iIndiceEdited = iIndiceToEdit;

    let crypto = aOfCryptos[iIndiceToEdit];

    $("#nom_crypto").val(crypto["nom"]);
    $("#symbole_crypto").val(crypto["symbole"]);
    $("#reseau").val(String(crypto["id_reseau"]));
    $("#quantite").val(crypto["quantite"]);
    $("#prix_achat").val(crypto["prix"]);
    $("#date_achat").val(crypto["dateAchat"]);
    $("#notes").val(crypto["notes"]);

    $('input[name="niveau_risque"]').prop("checked", false);
    $(
        'input[name="niveau_risque"][value="' +
        crypto["id_niveau_risque"] +
        '"]'
    ).prop("checked", true);

    $('input[name="strategies"]').prop("checked", false);
    for (let i = 0; i < (crypto["id_strategies"] || []).length; i++) {
        $(
            'input[name="strategies"][value="' +
            crypto["id_strategies"][i] +
            '"]'
        ).prop("checked", true);
    }

    $('input[name="notifications"]').prop("checked", false);
    let idsNotifications =
        crypto["id_notifications"] || crypto["id_notification"] || [];

    for (let j = 0; j < idsNotifications.length; j++) {
        $(
            'input[name="notifications"][value="' +
            idsNotifications[j] +
            '"]'
        ).prop("checked", true);
    }

    $("#titre_formulaire").text("Modifier la cryptomonnaie");
    $("#btn_ajouter").addClass("hide");
    $("#btn_modifier").removeClass("hide");
    $("#section_formulaire").removeClass("hide");

    document.getElementById("section_formulaire").scrollIntoView({
        behavior: "smooth",
        block: "start"
    });
}

function modifierCrypto() {
    if (iIndiceEdited === null) return;

    aOfCryptos[iIndiceEdited] = recupererDonneesFormulaire(
        aOfCryptos[iIndiceEdited]
    );

    rebuildTableau();
    annulerModification();
}

function supprimerCrypto(iIndiceToDelete) {
    let crypto = aOfCryptos[iIndiceToDelete];

    let confirmation = confirm(
        "Voulez-vous vraiment supprimer " +
        crypto["nom"] +
        " du portfolio ?"
    );

    if (!confirmation) return;

    aOfCryptos.splice(iIndiceToDelete, 1);
    rebuildTableau();
}

$(document).ready(function () {
    constructTable();
    tableCryptos = $("#table_cryptos").DataTable(configuration);
    calculerPortfolio();

    $("#form_crypto").on("submit", function (event) {
        event.preventDefault();

        if (iIndiceEdited === null) {
            ajouterCrypto();
        } else {
            modifierCrypto();
        }
    });
});