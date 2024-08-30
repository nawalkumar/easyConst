const newsData = [
    {
        title: '1. Constitution (Jammu and Kashmir) Scheduled Tribes Order (Amendment) Bill, 2024',
        description: 'Details: The Lok Sabha passed this bill to include four ethnic groups—Gadda Brahmins, Kolis, Paddari Tribe, and the Pahari Ethnic Group—into the Scheduled Tribes (ST) list in Jammu and Kashmir. This inclusion is aimed at ensuring their socio-economic and political empowerment. The bill also maintains existing reservations for other ST communities like Gujjars and Bakarwals while providing new reservations for the newly listed groups.',
        link: 'https://www.drishtiias.com/daily-updates/daily-news-analysis/constitution-j-k-st-order-amendment-bill-2024'
    },
    {
        title: '2. Establishment of Indias First Constitution Museum',
        description: 'Details: O.P. Jindal Global University has announced the creation of the countrys first Constitution Museum to commemorate the 75th anniversary of the adoption of the Constitution of India. The museum will showcase the history and evolution of the Indian Constitution, emphasizing its importance in shaping modern India.',
        link: 'https://example.com/constitution-museum'
    },
    {
        title: '3. Supreme Courts Ruling on Sub-Classification of Scheduled Castes',
        description: 'Details: The Supreme Court addressed the constitutionality of sub-classifying Scheduled Castes for reservations in its recent judgment. This debate revolves around whether such sub-classifications violate the principles of equality enshrined in the Constitution.'
    },
    {
        title: '4. Delhi High Courts Dismissal of PIL on "Samvidhaan Hatya Diwas"',
        description: 'Details: The Delhi High Court recently dismissed a Public Interest Litigation (PIL) challenging the central governments notification declaring June 25 as Samvidhaan Hatya Diwas(Constitution Killing Day). The petition argued that the notification was unconstitutional, but the court upheld the governments decision.',
         link: 'https://example.com/constitution-museum'
    },
    {
        title: '5. Supreme Courts Commentary on Judicial Restraint',
        description: 'Details: In a recent observation, the Supreme Court emphasized the need for judges to exercise restraint in their remarks, particularly in the context of live-streamed proceedings. This commentary underscores the constitutional principle of judicial decorum and the impact of public perception on the judiciary.',
         link: 'https://example.com/constitution-museum'
    },
    {
        title: '6. Supreme Court on Double Jeopardy',
        description: 'Details: The Supreme Court recently dealt with the concept of double jeopardy, which prohibits someone from being tried twice for the same offense. The court highlighted inconsistencies in how this principle has been applied in India, sparking discussions on constitutional protections and the need for clearer legal frameworks.',
         link: 'https://example.com/constitution-museum'
    },
    {
        title: '7. Rajasthan High Court on the Right to Speedy Trial',
        description: 'Details: The Rajasthan High Court released an accused in a murder case after three years, citing the constitutional right to a speedy trial. The court ruled that the heinousness of a crime should not override the fundamental right to a timely trial, as enshrined in the Constitution.',
         link: 'https://example.com/constitution-museum'
    },
    {
        title: '8. Supreme Courts Commentary on Judicial Overreach',
        description: 'Details: In a recent judgment, the Supreme Court cautioned against judicial overreach, where courts may exceed their constitutional mandate by encroaching on the powers of the executive and legislature. The court emphasized the need for a balance between the three branches of government to maintain the integrity of the Constitution.',
         link: 'https://example.com/constitution-museum'
    },
    {
        title: '9. Bombay High Court Judgment on Right to Education',
        description: 'Details: The Bombay High Court delivered a judgment celebrating the purpose of the Right to Education (RTE) Act, emphasizing its constitutional backing. The court ruled in favor of enforcing provisions that ensure equitable access to education for all children, regardless of their socio-economic background.',
         link: 'https://example.com/constitution-museum'
    },
    {
        title: '10. Debate on the National Judicial Appointments Commission (NJAC)',
        description: 'Details: Discussions have resurfaced around the National Judicial Appointments Commission (NJAC), which was struck down by the Supreme Court in 2015 for violating the basic structure of the Constitution. Recent debates focus on revisiting this decision, with arguments for and against the need for reform in the judicial appointment process.',
         link: 'https://example.com/constitution-museum'
    },
    {
        title: '11. Constitutional Amendment Bill on Womens Reservation',
        description: 'Details: Discussions around a potential Constitutional Amendment Bill to reserve 33% of seats for women in the Parliament and State Assemblies gained traction. This long-pending bill, if passed, would mark a significant step towards gender equality in Indian politics.',
         link: 'https://example.com/constitution-museum'
    },
    {
        title: '12. Supreme Court Ruling on Freedom of Speech',
        description: 'Details: The Supreme Court ruled on a case concerning the limits of freedom of speech under Article 19(1)(a) of the Constitution. The case involved the legality of social media restrictions imposed by the government, sparking debates on censorship and freedom of expression.',
         link: 'https://example.com/constitution-museum'
    },
];
function readText(text) {
    window.speechSynthesis.cancel();
    const utterance = new SpeechSynthesisUtterance(text);
    window.speechSynthesis.speak(utterance);
}

function createContent() {
    const contentDiv = document.getElementById('content');
    newsData.forEach(item => {
        const newsCard = document.createElement('div');
        newsCard.className = 'news-card bg-gray-210 p-6 mb-5 rounded-lg shadow-md';

        const title = document.createElement('h2');
        title.className = 'text-xl font-bold mb-2';
        title.innerText = item.title;

        const description = document.createElement('p');
        description.className = 'text-gray-700  p-5 mt-5 mx-50 w-11/12 md:w-7/10 lg:w-full  mb-16 break-words"';
        description.innerText = item.description;

        const link = document.createElement('a');
        link.className = 'text-blue-500 underline mt-2 block';
        link.href = item.link;
        link.target = '_main';
        link.innerText = 'Read more';

        const button = document.createElement('button');
        button.className = 'mt-3 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600';
        button.innerText = 'Read Description';
        button.onclick = () => readText(item.description);

        // Quiz button
        const quizButton = document.createElement('button');
        quizButton.className = 'mt-3 ml-2 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600';
        quizButton.innerText = 'Quiz';
        quizButton.onclick = () => window.open('quiz2.php', '_main');

        // Debate button
        const debateButton = document.createElement('button');
        debateButton.className = 'mt-3 ml-2 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600';
        debateButton.innerText = 'Debate';
        debateButton.onclick = () => window.open(debate.php, '_main');

        newsCard.appendChild(title);
        newsCard.appendChild(description);
        newsCard.appendChild(button);
        newsCard.appendChild(quizButton);  // Adding the Quiz button
        newsCard.appendChild(debateButton);  // Adding the Debate button
        newsCard.appendChild(link);

        contentDiv.appendChild(newsCard);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    createContent();
});
