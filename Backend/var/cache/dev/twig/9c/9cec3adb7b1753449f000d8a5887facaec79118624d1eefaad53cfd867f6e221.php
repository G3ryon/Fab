<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* impression3d/index.html.twig */
class __TwigTemplate_efc44cc570d215fc519909a1caffc1eb6a7236d5d2815dc21263fe07fbe31bd6 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "impression3d/index.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "impression3d/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "impression3d/index.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 5
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        echo "    <h2>Affichage des impressions 3D</h2>

    <div>";
        // line 8
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["Day"]) || array_key_exists("Day", $context) ? $context["Day"] : (function () { throw new RuntimeError('Variable "Day" does not exist.', 8, $this->source); })()), 'form');
        echo "</div>


    ";
        // line 11
        if (((isset($context["Sub"]) || array_key_exists("Sub", $context) ? $context["Sub"] : (function () { throw new RuntimeError('Variable "Sub" does not exist.', 11, $this->source); })()) == 0)) {
            // line 12
            echo "        <h1>";
            echo twig_escape_filter($this->env, (isset($context["forma"]) || array_key_exists("forma", $context) ? $context["forma"] : (function () { throw new RuntimeError('Variable "forma" does not exist.', 12, $this->source); })()), "html", null, true);
            echo "</h1>
    <table>
    <tr>
        <th>Matricule</th>
        <th>Nom du print</th>
        <th>Matière</th>
        <th>Temps d'impression</th>
        <th>Prix</th>
        <th>Heure de lancement</th>
        <th>Fichier</th>
    </tr>

        ";
            // line 24
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["Data"]) || array_key_exists("Data", $context) ? $context["Data"] : (function () { throw new RuntimeError('Variable "Data" does not exist.', 24, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["infos"]) {
                // line 25
                echo "        <tr>
        <td>";
                // line 26
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["infos"], "Utilisateur", [], "any", false, false, false, 26), "html", null, true);
                echo "</td>
        <td>";
                // line 27
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["infos"], "Nom", [], "any", false, false, false, 27), "html", null, true);
                echo "</td>
            <td>";
                // line 28
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["infos"], "Matiere", [], "any", false, false, false, 28), "html", null, true);
                echo "</td>
            <td>";
                // line 29
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["infos"], "Temps", [], "any", false, false, false, 29), "html", null, true);
                echo "</td>
            <td>";
                // line 30
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["infos"], "Prix", [], "any", false, false, false, 30), "html", null, true);
                echo "</td>
            <td>";
                // line 31
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["infos"], "Heure", [], "any", false, false, false, 31), "html", null, true);
                echo "</td>
            <td><a href=\"";
                // line 32
                echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("ddl", ["ddl" => twig_get_attribute($this->env, $this->source, $context["infos"], "PrintFilename", [], "any", false, false, false, 32)]), "html", null, true);
                echo "\"> ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["infos"], "PrintFilename", [], "any", false, false, false, 32), "html", null, true);
                echo "</a></td>
        </tr>

        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['infos'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 36
            echo "
        </table>

    ";
        }
        // line 40
        echo "    ";
        if (((isset($context["Sub"]) || array_key_exists("Sub", $context) ? $context["Sub"] : (function () { throw new RuntimeError('Variable "Sub" does not exist.', 40, $this->source); })()) == 3)) {
            // line 41
            echo "        <h1>";
            echo twig_escape_filter($this->env, (isset($context["forma"]) || array_key_exists("forma", $context) ? $context["forma"] : (function () { throw new RuntimeError('Variable "forma" does not exist.', 41, $this->source); })()), "html", null, true);
            echo "</h1>
        <h1>Il n'y a rien de programmé ce jour là</h1>
    ";
        }
        // line 44
        echo "    <div>
        <h2>Formulaire d'ajout d'une impression3D.</h2>
        ";
        // line 46
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["impression3dForm"]) || array_key_exists("impression3dForm", $context) ? $context["impression3dForm"] : (function () { throw new RuntimeError('Variable "impression3dForm" does not exist.', 46, $this->source); })()), 'form');
        echo "
    </div>

";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "impression3d/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  159 => 46,  155 => 44,  148 => 41,  145 => 40,  139 => 36,  127 => 32,  123 => 31,  119 => 30,  115 => 29,  111 => 28,  107 => 27,  103 => 26,  100 => 25,  96 => 24,  80 => 12,  78 => 11,  72 => 8,  68 => 6,  58 => 5,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}



{% block body %}
    <h2>Affichage des impressions 3D</h2>

    <div>{{form(Day)}}</div>


    {% if Sub == 0 %}
        <h1>{{forma}}</h1>
    <table>
    <tr>
        <th>Matricule</th>
        <th>Nom du print</th>
        <th>Matière</th>
        <th>Temps d'impression</th>
        <th>Prix</th>
        <th>Heure de lancement</th>
        <th>Fichier</th>
    </tr>

        {% for infos in Data %}
        <tr>
        <td>{{ infos.Utilisateur }}</td>
        <td>{{ infos.Nom }}</td>
            <td>{{ infos.Matiere }}</td>
            <td>{{ infos.Temps }}</td>
            <td>{{ infos.Prix }}</td>
            <td>{{ infos.Heure }}</td>
            <td><a href=\"{{ path('ddl',{ddl:infos.PrintFilename }) }}\"> {{ infos.PrintFilename }}</a></td>
        </tr>

        {% endfor %}

        </table>

    {% endif %}
    {% if Sub ==3 %}
        <h1>{{forma}}</h1>
        <h1>Il n'y a rien de programmé ce jour là</h1>
    {% endif %}
    <div>
        <h2>Formulaire d'ajout d'une impression3D.</h2>
        {{ form(impression3dForm) }}
    </div>

{% endblock %}
", "impression3d/index.html.twig", "C:\\Users\\dtheo\\Fab\\Backend\\templates\\impression3d\\index.html.twig");
    }
}