<% include Header %>

<main role="main">
<div class="container">
    <h1>$Title</h1>
    <div class="faq-section accordion" id="accordion">
    <% loop $Categories %>
        <% if $Up.Categories.Count > 1 %>
            <h2>$Title</h2>
            <hr>
        <% end_if %>
        <ul>
            <% loop $Questions %>
                <li>
                    <h3 data-toggle="collapse" data-target="#collapse_$ID" aria-expanded="false" aria-controls="collapse_$ID"><span class="icon fal fa-angle-right"></span> $Question</h3>
                    <div id="collapse_$ID" class="collapse" data-parent="#accordion">
                        $Answer
                    </div>
                </li>
            <% end_loop %>
        </ul>
    <% end_loop %>
    </div>
</div>
</main>

<% include Footer %>
