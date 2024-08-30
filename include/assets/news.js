const newsData = [
    {
        title: '1. Constitution (Jammu and Kashmir) Scheduled Tribes Order (Amendment) Bill, 2024',
        description: 'Details: The Lok Sabha passed this bill to include four ethnic groups—Gadda Brahmins, Kolis, Paddari Tribe, and the Pahari Ethnic Group—into the Scheduled Tribes (ST) list in Jammu and Kashmir. This inclusion is aimed at ensuring their socio-economic and political empowerment. The bill also maintains existing reservations for other ST communities like Gujjars and Bakarwals while providing new reservations for the newly listed groups.'
    },
    {
        title: '2. Establishment of Indias First Constitution Museum',
        description: 'Details: O.P. Jindal Global University has announced the creation of the countrys first Constitution Museum to commemorate the 75th anniversary of the adoption of the Constitution of India. The museum will showcase the history and evolution of the Indian Constitution, emphasizing its importance in shaping modern India.'
    },
    {
        title: '3. Supreme Courts Ruling on Sub-Classification of Scheduled Castes',
        description: 'Details: The Supreme Court addressed the constitutionality of sub-classifying Scheduled Castes for reservations in its recent judgment. This debate revolves around whether such sub-classifications violate the principles of equality enshrined in the Constitution.'
    },
    {
        title: '4. Delhi High Courts Dismissal of PIL on "Samvidhaan Hatya Diwas"',
        description: 'Details: The Delhi High Court recently dismissed a Public Interest Litigation (PIL) challenging the central governments notification declaring June 25 as Samvidhaan Hatya Diwas(Constitution Killing Day). The petition argued that the notification was unconstitutional, but the court upheld the governments decision.'
    },
    {
        title: '5. Supreme Courts Commentary on Judicial Restraint',
        description: 'Details: In a recent observation, the Supreme Court emphasized the need for judges to exercise restraint in their remarks, particularly in the context of live-streamed proceedings. This commentary underscores the constitutional principle of judicial decorum and the impact of public perception on the judiciary.'
    },
    {
        title: '6. Supreme Court on Double Jeopardy',
        description: 'Details: The Supreme Court recently dealt with the concept of double jeopardy, which prohibits someone from being tried twice for the same offense. The court highlighted inconsistencies in how this principle has been applied in India, sparking discussions on constitutional protections and the need for clearer legal frameworks.'
    },
    {
        title: '7. Rajasthan High Court on the Right to Speedy Trial',
        description: 'Details: The Rajasthan High Court released an accused in a murder case after three years, citing the constitutional right to a speedy trial. The court ruled that the heinousness of a crime should not override the fundamental right to a timely trial, as enshrined in the Constitution.'
    },
    {
        title: '8. Supreme Courts Commentary on Judicial Overreach',
        description: 'Details: In a recent judgment, the Supreme Court cautioned against judicial overreach, where courts may exceed their constitutional mandate by encroaching on the powers of the executive and legislature. The court emphasized the need for a balance between the three branches of government to maintain the integrity of the Constitution.'
    },
    {
        title: '9. Bombay High Court Judgment on Right to Education',
        description: 'Details: The Bombay High Court delivered a judgment celebrating the purpose of the Right to Education (RTE) Act, emphasizing its constitutional backing. The court ruled in favor of enforcing provisions that ensure equitable access to education for all children, regardless of their socio-economic background.'
    },
    {
        title: '10. Debate on the National Judicial Appointments Commission (NJAC)',
        description: 'Details: Discussions have resurfaced around the National Judicial Appointments Commission (NJAC), which was struck down by the Supreme Court in 2015 for violating the basic structure of the Constitution. Recent debates focus on revisiting this decision, with arguments for and against the need for reform in the judicial appointment process.'
    },
    {
        title: '11. Constitutional Amendment Bill on Womens Reservation',
        description: 'Details: Discussions around a potential Constitutional Amendment Bill to reserve 33% of seats for women in the Parliament and State Assemblies gained traction. This long-pending bill, if passed, would mark a significant step towards gender equality in Indian politics.'
    },
    {
        title: '12. Supreme Court Ruling on Freedom of Speech',
        description: 'Details: The Supreme Court ruled on a case concerning the limits of freedom of speech under Article 19(1)(a) of the Constitution. The case involved the legality of social media restrictions imposed by the government, sparking debates on censorship and freedom of expression.'
    },
];




function readText(text) {
    // Cancel any ongoing speech
    window.speechSynthesis.cancel();

    // Create a new SpeechSynthesisUtterance
    const utterance = new SpeechSynthesisUtterance(text);

    // Speak the new text
    window.speechSynthesis.speak(utterance);
}

function createContent() {
    const contentDiv = document.getElementById('content');
    newsData.forEach(item => {
        const newsCard = document.createElement('div');
        newsCard.className = 'news-card bg-white p-6 mb-5 rounded-lg shadow-md';

        const title = document.createElement('h2');
        title.className = 'text-xl font-bold mb-2';
        title.innerText = item.title;

        const description = document.createElement('p');
        description.className = 'text-gray-700';
        description.innerText = item.description;

        const button = document.createElement('button');
        button.className = 'mt-3 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600';
        button.innerText = 'Read Description';
        button.onclick = () => readText(item.description);

        newsCard.appendChild(title);
        newsCard.appendChild(description);
        newsCard.appendChild(button);

        contentDiv.appendChild(newsCard);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    createContent();
});
